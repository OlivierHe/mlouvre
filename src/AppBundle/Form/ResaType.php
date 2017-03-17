<?php
// src/AppBundle/Form/ResaType.php
namespace AppBundle\Form;

use AppBundle\Entity\Resa;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                array('attr'=> array('class'=>'form-control date_naissance', 'placeholder' => 'Cliquez ici'), 'label' => 'Date de naissance',
                                    'widget' => 'single_text', 'html5' => false,
                                    'format' => 'dd/MM/yyyy' 
                ))
            ->add('jour_visite',    DateType::class, 
                array('attr'=> array('class'=>'form-control jour_visite', 'placeholder' => 'Cliquez ici'),'label' => 'Jour de la visite',
                                     'widget' => 'single_text', 'html5' => false,
                                     'format' => 'dd/MM/yyyy'               
                ))
            ->add('type_billets',   ChoiceType::class, 
                array('attr'=> array('class'=>'form-control'), 'label' => 'Type de billets',
                'choices' => array('Journée' => 'Journée', 'Demi-journée' => 'Demi-journée')
                ))
            ->add('tarif_reduit', 	CheckboxType::class, 
                array('attr'=> array('class'=>'form-control'),'label' => 'Tarif réduit',  'required' => false
                ))
        ;
     }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Resa::class
        ));


    }
}