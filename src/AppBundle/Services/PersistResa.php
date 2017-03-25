<?php
// src/AppBundle/Services/PersistResa.php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\MoreResa;
use AppBundle\Entity\Resa;
use AppBundle\Form\MoreResaType;
use AppBundle\Form\ResaType;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PersistResa 
{
	private $form;
	private $doctrine;
	private $session;
	private $router;
	private $dateToday;

	public function __construct(EntityManager $doctrine,FormFactory $form,Session $session,Router $router) 
	{
	  date_default_timezone_set("Europe/Paris");

	  $this->doctrine = $doctrine;
	  $this->form  = $form; 
	  $this->session = $session;
	  $this->router = $router;
	  $this->dateToday = new \DateTime("now");
	  $this->tropResa = false;
	}

	public function getForm(Request $request)
	{
		$em = $this->doctrine;

        if(!isset($form)) 
        {
			$moreResa = new MoreResa();
	       
	        $qty = $request->getSession()->get('quantite_ticket');

			if ($qty >= 1 AND $qty <= 10) {
            	for ($i = 1; $i <= $qty; $i++)
		        {
		            ${'resa' . $i} = new Resa();
		            $moreResa->getResas()->add(${'resa' . $i});
		        }	
			    $form = $this->form->create(MoreResaType::class, $moreResa, array('attr' => array('class' => 'form-horizontal')));
            } else {
	          	$this->failedResa();
		    }
     	}

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$prixTotal = 0;

            foreach($moreResa->getResas() as $resa) 
            {
            	$rawVisite = $resa->getJourVisite();
            	// validation
                $this->validVisite($rawVisite, $resa->getTypeBillets());
                $this->countTicket($em,$rawVisite);
                $age = $this->getAge($resa->getDateNaissance());
            	$prixTicket = $this->getPrice($age,$resa->getTarifReduit());
            	$resa->setResaNumber();
            	$resa->setPrixTicket($prixTicket);
            	$prixTotal += $prixTicket;
			}

	            $moreResa->setPrixTotal($prixTotal);

	            if(!$this->tropResa) {
                    $request->getSession()->set('prix_total', $prixTotal);  
                    $request->getSession()->set('more_resa',$moreResa);
		            $te = new RedirectResponse('paiement');
		    	    return $te->send();
	            }
        }

        return $form;
    
	}

	public function persistTickets()
	{
		$em = $this->doctrine;
		$moreResa = $this->session->get('more_resa');
		// verifieer si l'entité est null
		$em->persist($moreResa);
		$em->flush();
	}

	private function countTicket($em,$rawVisite)
	{
		 $jVisite = $rawVisite->format('Y-m-d');
		 $query = $em->createQuery(
			'SELECT COUNT(r.jour_visite)
			FROM AppBundle:Resa r
			WHERE r.jour_visite = :jvisite'
			)->setParameter('jvisite', $jVisite);

		$nTickets = $query->setMaxResults(1)->getOneOrNullResult();;
		$nTickets = intval($nTickets[1]);

		if ($nTickets > 1000) {
			   $this->tooMuchResa($rawVisite);
		}
	}

	private function tooMuchResa($rawVisite) 
	{
		$formatJv = $rawVisite->format('d/m/Y');
		 $this->session->getFlashBag()
		 ->add('danger', 'Trop de réservations à la date du '.$formatJv. ' Veuillez choisir un autre jour.');
		 $this->tropResa = true;
	
	}

	private function failedResa() 
	{
		$fail = new RedirectResponse("failedresa");
        return $fail->send();
	}

	private function validVisite($jourVisite,$typeBillets)
    {
        $dateToday = $this->dateToday;
        $disabledDay = array("01/01","01/05","08/08","14/07","15/08","01/11","11/11","25/12");
        $formatJv = $jourVisite->format('d/m');
        $formatDt = $dateToday->format('d/m');
        $formatDay = $jourVisite->format('l');

		if (in_array($formatJv, $disabledDay) || $formatDay == "Tuesday" || $formatDay == "Sunday") {
			$this->failedResa();
		} else if((date("H:i")) >= "14:00" AND $formatDt == $formatJv AND $typeBillets == "Journée") {
			$this->failedResa();
		}
    }

	private function getAge($birthDate)
	{
		$dateToday = $this->dateToday;
		$interval = $birthDate->diff($dateToday);

		return $interval->format('%y');
	}

	private function getPrice($age,$tarifReduit) 
	{
		$ageInt = intval($age);

  		if ($ageInt < 4):
  			return 0;
  		elseif($ageInt >= 4 AND $ageInt < 12):
  			return 8;
  		elseif ($tarifReduit):
			return 10;
  		elseif($ageInt >= 60):
  			return 12;
  		else:
  			return 16;
  		endif;

	}

}