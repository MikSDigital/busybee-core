<?php

namespace General\ValidationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ValidatorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ValidatorRepository extends EntityRepository
{
	
	public function createNew() 
	{
		return new \General\ValidationBundle\Entity\Validator();
	}
}
