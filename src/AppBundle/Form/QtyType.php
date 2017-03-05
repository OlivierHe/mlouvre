<?php
// src/AppBundle/Form/QtyType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Choice;

class QtyType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('quantite', 			ChoiceType::class, 
                array('attr'=> array('class'=>'form-control'), 'label' => 'Quantité de billets',
                'choices' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4,'5' => 5,'6' => 6, '7' => 7, '8' => 8,'9' => 9,'10' => 10),
                 'constraints' => array(
                     new Choice(array ('1','2','3','4','5','6','7','8','9','10')),
                     new NotBlank(array("message" => "Vous devez remplir ce champ"))
                 )
        ));
    }
}