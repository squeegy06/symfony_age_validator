<?php

/**
 * Validator\Constraint\AgeValidator
 * 
 * @author Jason Tolhurst <jtolhurst01@aol.com>
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\MissingOptionsException;

/**
 * @Annotation
 */
class Age extends Constraint
{	
	const SCALE_YEARS = 'years';
	const SCALE_MONTHS = 'months';
	const SCALE_DAYS = 'days';
	
	protected static $valid_scales = array(
		self::SCALE_YEARS,
		self::SCALE_MONTHS,
		self::SCALE_DAYS
	);

	public $scale = self::SCALE_YEARS;
	
	public $min = null;
	
	public $max = null;
	
	public $minAgeMessage = 'Must be more than %age% %scale% old.';
	
	public $maxAgeMessage = 'Must be less than %age% %scale% old.';
	
	public function __construct($options = null)
	{
		parent::__construct($options);
		
		if(!in_array($this->scale, self::$valid_scales))
		{
			throw new ConstraintDefinitionException(sprintf('The option "scale" must be one of "%s"' , implode('", "', self::$valid_scales)));
		}
		
		if (null === $this->min && null === $this->max) {
            throw new MissingOptionsException(sprintf('Either option "min" or "max" must be given for constraint %s', __CLASS__), array('min', 'max'));
        }
	}
}