<?php
// src/AppBundle/Services/Mailer.php
namespace AppBundle\Services;


class Mailer {

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer,\Twig_environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
    
    public function send($data) {
    
        $message = \Swift_Message::newInstance()
                ->setSubject($data["titremessage"])
                ->setFrom($data["email"])
                ->setTo('olivier.herzog@gmail.com')
                ->setBody(
                            $this->twig->render(
                                'emails/demandeInfo.html.twig',
                                array('nom' => $data["nom"], 'prenom' => $data["prenom"], 'message' => $data["message"], 'email' => $data["email"])
                            ),'text/html');
         
                
        $this->mailer->send($message);
        
        
    }

}