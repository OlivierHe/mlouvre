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
    private $mailer;


    public function __construct(Session $session, Router $router,PersistResa $persistresa,Mailer $mailer) 
    {
      $this->session = $session;
      $this->router = $router;  
      $this->persistresa = $persistresa;
      $this->mailer = $mailer;

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
                        "description" => "Paiement Stripe - Musée du Louvre"
                    ));
                    $this->mailer->sendBillets($request->request->get('stripeEmail'));
                    $this->persistresa->persistTickets();
                } catch(\Stripe\Error\Card $e) {
                    $e->getMessage();
                }
            
        }

    }

}