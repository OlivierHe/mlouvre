<?php 
// src/AppBundle/Validator/Constraints/IsValidDayDateValidator.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidDayDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
    	$disabledDay = array("01/01","01/05","08/08","14/07","15/08","01/11","11/11","25/12");
        $formatJv = $value->format('d/m');
        $formatDay = $value->format('l');

		if (in_array($formatJv, $disabledDay) || $formatDay == "Tuesday" || $formatDay == "Sunday"){
                $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $formatJv)->addViolation();
        }
    }
}