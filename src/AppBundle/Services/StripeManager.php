<?php
// src/AppBundle/Services/StripeManger.php

namespace AppBundle\Services;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StripeManager {


    private $session;
    private $router;
    private $persistresa;


    public function __construct(Session $session, Router $router,PersistResa $persistresa) 
    {
      $this->session = $session;
      $this->router = $router;  
      $this->persistresa = $persistresa;

    }

    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_HlK1hlfermjxndVAk6gQeP45");

        // Get the credit card details submitted by the form
         if ($request->isMethod('POST')) {

                try {
                    $charge = \Stripe\Charge::create(array(
                        "amount" => ($this->session->get('prix_total')*100), // Amount in cents
                        "currency" => "eur",
                        "source" => $request->request->get('stripeToken'),
                        "description" => "Paiement Stripe - OpenClassrooms Exemple"
                    ));
                    $this->session->getFlashBag()
                    ->add("success","Bravo ça marche !");
                    // 'stripeEmail'  envoie de billet ici
                    $this->persistresa->persistTickets();
           //         return $this->redirectToRoute("order_prepare");
                } catch(\Stripe\Error\Card $e) {
                    var_dump("Denied !");
                    $this->session->getFlashBag()
                    ->add("error","Snif ça marche pas :(");
             //       return $this->redirectToRoute("order_prepare");
                    // The card has been declined
                }
            
        }

    }

}