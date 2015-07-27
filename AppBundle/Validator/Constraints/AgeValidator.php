<?php

/**
 * Validator\Constraint\AgeValidator
 * 
 * @author Jason Tolhurst <jtolhurst01@aol.com>
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class AgeValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
	{
		if(!$constraint instanceof Age)
		{
			throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Age');
		}
		
		if($value === NULL || $value === '')
		{
			return;
		}
		
		if(!$value instanceof \DateTime)
		{
			throw new UnexpectedTypeException($value, '\DateTime');
		}
		
		$now = new \DateTime();
		
		$diff = $now->diff($value);
		
		$age = null;
		
		$min = (int) $constraint->min;
		
		$max = (int) $constraint->max;
		
		switch($constraint->scale)
		{
			case $constraint::SCALE_YEARS:
				$age = $diff->y;
				break;
			
			case $constraint::SCALE_MONTHS:
				$age = $diff->y * 12 ;
				break;

			case $constraint::SCALE_DAYS:
				$age = $diff->y * 365;
				break;
			
			default:
				return;
		}
		
		if($constraint->min !== NULL && $age < $min)
		{
			$this->buildViolation($constraint->minAgeMessage)
				->setParameter("%age%", $min)
				->setParameter("%scale%", $constraint->scale)
				->addViolation();
		}
		
		if($constraint->max !== NULL && $age > $max)
		{
			$this->buildViolation($constraint->maxAgeMessage)
				->setParameter("%age%", $max)
				->setParameter("%scale%", $constraint->scale)
				->addViolation();
		}
		
		return;
	}
}