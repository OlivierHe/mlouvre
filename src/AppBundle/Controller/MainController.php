<?php

namespace AppBundle\Controller;


use AppBundle\Entity\MoreResa;
use AppBundle\Entity\Resa;
use AppBundle\Form\MoreResaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class MainController extends Controller
{
    /**
     * @Route("/{_locale}", name="accueil", defaults={"_locale": "fr"}, requirements={
     *     "_locale": "en|fr"
     * })
     */
    public function accueilAction(Request $request,$_locale)
    {
        $request->getSession()->set('_locale', $_locale);

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
        $form = $this->get('app.persistresa')->getForm($request);

        return $this->render('child/moreresa.html.twig', array(
            'form' => $form->createView()
        ));
     }


     /**
     * @Route("/succesresa", name="succesresa")
     */
     public function succesResaAction()
     {
        return $this->render('child/succesresa.html.twig');
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
