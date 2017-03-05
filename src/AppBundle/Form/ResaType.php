<?php
// src/AppBundle/Form/ResaType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ResaType extends AbstractType 
{
     public function buildForm(FormBuilderInterface $builder, array $options) 
     {
        $builder
        	->add('nom', 			TextType::class, 
                array('attr'=> array('class'=>'form-control')
                ))
        	->add('prenom', 		TextType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Prénom'
                ))
            ->add('email', EmailType::class, array('attr'=> array('class'=>'form-control'),'label' => 'Courriel'
                ))
            ->add('pays', 			CountryType::class, 
                array('attr'=> array('class'=>'form-control')
                ))
            ->add('date_naissance', BirthdayType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Date de naissance'
                ))
            ->add('jour_visite',    DateType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Jour de la visite'
                ))
            ->add('type_billets',   ChoiceType::class, 
                array('attr'=> array('class'=>'form-control'), 'label' => 'Type de billets',
                'choices' => array('Journée' => 'Journée', 'Demi-journée' => 'Demi-journée')
                ))
            ->add('token',          HiddenType::class,
                array('data' => base64_encode(random_bytes(10)),
                ))
            ->add('tarif_reduit', 	CheckboxType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Tarif réduit'
                ))
        ;
     }
}