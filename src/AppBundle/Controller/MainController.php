<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueilAction()
    {
        //$session = new Session();
     
        return $this->render('child/accueil.html.twig');
    }

    /**
     * @Route("/quantite_ticket", name="quantite_ticket")
     */
     public function qtyTicketAction(Request $request)
     {
        $form = $this->createForm('AppBundle\Form\QtyType',null,array('attr' => array('class' => 'form-horizontal')));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){

                $data = $form->getData();
                // sauvegarde la quantité de tickets
                $request->getSession()->set('quantite_ticket', $data['quantite']);  
                return $this->redirectToRoute('resa');
            }
        }

        return $this->render('child/qty_ticket.html.twig', array(
            'form' => $form->createView()
        ));    
     }

    /**
     * @Route("/reservation", name="resa")
     */
     public function resaAction(Request $request)
     {
        //$request->getSession()->get('quantite_ticket')

        $form = $this->createForm('AppBundle\Form\ResaType',null,array('attr' => array('class' => 'form-horizontal')));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                $data = $form->getData();
            var_dump($data['tarif_reduit']);
            }
        }


          return $this->render('child/resa.html.twig', array(
            'form' => $form->createView()
        ));
     }

     /**
     * @Route("/cgv", name="cgv")
     */
    public function cgvAction()
    {
        return $this->render('child/cgv.html.twig');
    }

     /**
     * @Route("/acces_infos_pratiques", name="acip")
     */
    public function acipAction()
    {
        return $this->render('child/acip.html.twig');
    }

    /**
     * @Route("/nous_contacter", name="contact")
     */
    public function contactAction(Request $request)
    {
        
         $form = $this->createForm('AppBundle\Form\ContactType',null,array('attr' => array('class' => 'form-horizontal')));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                $data = $form->getData();
                
                $this->get('app.mailer')->send($data);
            }
        }

        return $this->render('child/contact.html.twig', array(
            'form' => $form->createView()
        ));

     
    }
}
