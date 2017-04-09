<?php
// src/AppBundle/Services/Mailer.php
namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;
use Endroid\QrCode\QrCode;

class Mailer {

    private $mailer;
    private $twig;
    private $session;
    private $translator;

    public function __construct(\Swift_Mailer $mailer,\Twig_environment $twig, Session $session,TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->session = $session;
        $this->translator = $translator;
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
         
        $this->session->getFlashBag()
             ->add('success', $this->translator->trans('Votre message à été envoyé, vous recevrez une réponse dans les 48 heures'));          

        $this->mailer->send($message);
        
        
    }

      public function sendBillets($emailTo) {

 
        
        $message = \Swift_Message::newInstance()
                ->setSubject("Billets pour le musée du Louvre")
                ->setFrom("billets@louvre.fr")
                ->setTo($emailTo)
                ->setBody(
                            $this->twig->render(
                                'emails/billets.html.twig'),'text/html');

        $message->attach(\Swift_Attachment::fromPath('images/logo.gif'));


        $moreResa = $this->session->get('more_resa');

        foreach($moreResa->getResas() as $key => $resa) {

            //var_dump($resa->getResaNumber());

            $qrCode = new QrCode();
            $qrCode->setText($resa->getResaNumber());

            // You can alternatively use method chaining to build the attachment
            $attachment = \Swift_Attachment::newInstance()
                            ->setFilename('qrcode'.$key.'.png')
                            ->setContentType($qrCode->getContentType())
                            ->setBody($qrCode->get());

            $message->attach($attachment);
        }
          var_dump($message);
          $this->mailer->send($message);
          

        
    }

}
