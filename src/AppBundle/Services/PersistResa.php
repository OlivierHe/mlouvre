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
	}

	public function getForm(Request $request)
	{

        if(!isset($form)) 
        {
			$moreResa = new MoreResa();
	        // mettre condition si qty n'existe pas'
	        $qty = $request->getSession()->get('quantite_ticket');

	        for ($i = 1; $i <= $qty; $i++)
	        {
	            ${'resa' . $i} = new Resa();
	           // ${'resa' . $i}->setPrixTicket(16);
	            $moreResa->getResas()->add(${'resa' . $i});
	        }	

			$form = $this->form->create(MoreResaType::class, $moreResa, array('attr' => array('class' => 'form-horizontal')));
     	}

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$prixTotal = 0;

            foreach($moreResa->getResas() as $resa) 
            {
            	$age = $this->getAge($resa->getDateNaissance());
            	$prixTicket = $this->getPrice($age,$resa->getTarifReduit());
            	$resa->setPrixTicket($prixTicket);
            	$prixTotal += $prixTicket;
			}

            $moreResa->setPrixTotal($prixTotal);
            $em = $this->doctrine;
            $em->persist($moreResa);
            $em->flush();

         //    $te = new RedirectResponse('succesresa');
    	    // return $te->send();
        }

        return $form;
    
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