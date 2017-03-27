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
	private $mailer;

	public function __construct(EntityManager $doctrine,FormFactory $form,Session $session,Router $router,Mailer $mailer) 
	{
	  date_default_timezone_set("Europe/Paris");

	  $this->doctrine = $doctrine;
	  $this->form  = $form; 
	  $this->session = $session;
	  $this->router = $router;
	  $this->mailer = $mailer;
	  $this->dateToday = new \DateTime("now");
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
                $tropDeTicket = $em->getRepository('AppBundle:Resa')->countTicket($rawVisite);
                if ($tropDeTicket) {
                	$formatJv = $rawVisite->format('d/m/Y');
                	 $this->session->getFlashBag()
				     ->add('danger', 'Trop de réservations à la date du '.$formatJv. ' Veuillez choisir un autre jour.');
				     break;
                }

            	$prixTicket = $this->getPrice($resa->getDateNaissance(),$resa->getTarifReduit());
            	$resa->setResaNumber();
            	$resa->setPrixTicket($prixTicket);
            	$prixTotal += $prixTicket;
			}

	            

	            if(!$tropDeTicket) {
	            	$moreResa->setPrixTotal($prixTotal);
                    $request->getSession()->set('prix_total', $prixTotal);  
                    $request->getSession()->set('more_resa',$moreResa);
                    if($prixTotal == 0) {
                    	$this->persistTickets();
                    	$this->mailer->sendBillets($moreResa->getResas()->first()->getEmail());
                    	$te = new RedirectResponse('succesresa');
			    	    $te->send();
                    } else {
			            $te = new RedirectResponse('paiement');
			    	    $te->send();
		    	    }
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

	private function failedResa() 
	{
		$fail = new RedirectResponse("failedresa");
        return $fail->send();
	}

	private function validVisite($jourVisite,$typeBillets)
    {
        $dateToday = $this->dateToday;
        $formatJv = $jourVisite->format('d/m');
        $formatDt = $dateToday->format('d/m');

		if((date("H:i")) >= "14:00" AND $formatDt == $formatJv AND $typeBillets == "Journée") {
			$this->failedResa();
		}
    }


	private function getPrice($birthDate,$tarifReduit) 
	{
	    $dateToday = $this->dateToday;
		$interval = $birthDate->diff($dateToday);
        $age =  $interval->format('%y');
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