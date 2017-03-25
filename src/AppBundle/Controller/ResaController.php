<?php

namespace AppBundle\Controller;


use AppBundle\Entity\MoreResa;
use AppBundle\Entity\Resa;
use AppBundle\Form\MoreResaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class ResaController extends Controller
{

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
        $form = $this->get('app.persistresa')->getForm($request);

        return $this->render('child/moreresa.html.twig', array(
            'form' => $form->createView()
        ));
     }

    /**
     * @Route("/paiement", name="paiement")
     */
     public function paiementAction()
     {
        return $this->render('child/paiement.html.twig');
     }


     /**
     * @Route("/succesresa", name="succesresa")
     */
     public function succesResaAction(Request $request)
     {
        $this->get('app.stripe_manager')->checkout($request);
        return $this->render('child/succesresa.html.twig');
     }

     /**
     * @Route("/failedresa", name="failedresa")
     */
     public function failedResaAction()
     {
        return $this->render('child/failedresa.html.twig');
     }
}