<?php
// src/AppBundle/Form/MoreResaType.php
namespace AppBundle\Form;

use AppBundle\Entity\MoreResa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoreResaType extends AbstractType 
{
     public function buildForm(FormBuilderInterface $builder, array $options) 
     {
        $builder
        ->add('resas', CollectionType::class, array( 
            'label' => 'false',
            'entry_type'   => ResaType::class, 
            'label' => false,
            'allow_delete' => true
        ));
     }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array( 
            'data_class' => MoreResa::class
        ));
    }
}