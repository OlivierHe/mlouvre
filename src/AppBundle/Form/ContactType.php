<?php
// src/AppBundle/Form/ContactType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('nom', 			TextType::class, 
                array('attr'=> array('class'=>'form-control'),
                'constraints' => array(
                    new Length(array("min" => 2,
                                     "max" => 100,
                                     "minMessage" => "Il faut 2 caractères minimum",
                                     "maxMessage" => "Il faut 100 caractères maximum"
                                     )),
                    new NotBlank(array("message" => "Vous devez remplir ce champ")),
                    new Regex(array("pattern" => "/^[a-zA-Z0-9_]*$/", "message" => "Seul les caractères alphanumériques sont autorisés"))
            )))
        	->add('prenom', 		TextType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Prénom',
                'constraints' => array(
                    new Length(array("min" => 2, "minMessage" => "Il faut 2 caractères minimum",
                                     "max" => 100, "maxMessage" => "Il faut 100 caractères maximum"
                                     )),
                    new NotBlank(array("message" => "Vous devez remplir ce champ")),
                    new Regex(array("pattern" => "/^[a-zA-Z0-9_]*$/", "message" => "Seul les caractères alphanumériques sont autorisés"))
            )))
            ->add('email', EmailType::class, array('attr'=> array('class'=>'form-control'),'label' => 'Courriel',
                'constraints' => array(
                    new NotBlank(array("message" => "Vous devez remplir ce champ")),
                    new Email(array("message" => "Ceci n’est pas une adresse email valide")),
                )
            ))
            ->add('titremessage',   TextType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Titre du message',
                'constraints' => array(
                    new Length(array("min" => 2, "minMessage" => "Il faut 2 caractères minimum",
                                     "max" => 100, "maxMessage" => "Il faut 100 caractères maximum"
                                     )),
                    new NotBlank(array("message" => "Vous devez remplir ce champ"))
            )))
            ->add('message', 			TextareaType::class, 
                array('attr'=> array('class'=>'form-control'),
                'constraints' => array(
                    new Length(array("min" => 2, "minMessage" => "Il faut 2 caractères minimum",
                                     "max" => 5000, "maxMessage" => "Il faut 5000 caractères maximum"
                                     )),
                    new NotBlank(array("message" => "Vous devez remplir ce champ"))     
            )))
        ;
    }
}