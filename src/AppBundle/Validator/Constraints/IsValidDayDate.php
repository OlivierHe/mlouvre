<?php 
// src/AppBundle/Validator/Constraints/IsValidDayDate.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsValidDayDate extends Constraint
{
    public $message = 'La reservation le "%string%" est impossible';
}
