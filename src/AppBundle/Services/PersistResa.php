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

	public function __construct(EntityManager $doctrine,FormFactory $form,Session $session,Router $router) 
	{
	  $this->doctrine = $doctrine;
	  $this->form  = $form; 
	  $this->session = $session;
	  $this->router = $router;
	}

	public function getForm(Request $request)
	{


		$moreResa = new MoreResa();
        // mettre condition si qty n'existe pas'
        $qty = $request->getSession()->get('quantite_ticket');

        for ($i = 1; $i <= $qty; $i++)
        {
            ${'resa' . $i} = new Resa();
            ${'resa' . $i}->setPrixTickets(10);
            $moreResa->getResas()->add(${'resa' . $i});
        }
        

        $form = $this->form->create(MoreResaType::class, $moreResa, array('attr' => array('class' => 'form-horizontal')));

        //if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            

            $em = $this->doctrine;
            $em->persist($moreResa);
            $em->flush();

            $te = new RedirectResponse('succesresa');
    	    return $te->send();
        }

        return $form;
    
	}

}