<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueilAction()
    {
        return $this->render('child/accueil.html.twig');
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
                // Send mail
                $message = \Swift_Message::newInstance()
                    ->setSubject($data["titremessage"])
                    ->setFrom($data["email"])
                    ->setTo('olivier.herzog@gmail.com')
                    ->setBody("de".$data["nom"]." ".$data["prenom"]. "<br>" .$data["message"]."<br>ContactMail :".$data["email"]);

               if($this->get('mailer')->send($message)) {
                   return $this->redirectToRoute('accueil');
               } else {
                    var_dump("Errooooor :(");   
               }  
            }
        }

        return $this->render('child/contact.html.twig', array(
            'form' => $form->createView()
        ));

     
    }
}
