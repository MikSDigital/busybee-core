<?php
namespace Busybee\PersonBundle\Validator ;

use Symfony\Component\Validator\Constraint;

class Phone extends Constraint
{
    public $message = 'person.error.phone';
	
	public function validatedBy()
	{
		return 'phone_validator' ; 
	}
	
	public function __construct()
	{
		parent::__construct();
		$this->addImplicitGroupName('Default');
		return $this ;
	}
}
