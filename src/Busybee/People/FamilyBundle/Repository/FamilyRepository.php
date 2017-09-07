<?php

namespace Busybee\People\FamilyBundle\Repository;

use Busybee\People\FamilyBundle\Entity\Family;

/**
 * FamilyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FamilyRepository extends \Doctrine\ORM\EntityRepository
{
	public function find($id)
	{
		$family = parent::find($id);

		return $family instanceof Family ? $family : new Family();
	}

	public function findByStudentsPerson($person)
	{
		$result = $this->createQueryBuilder('f')
			->leftJoin('f.students', 's')
			->leftJoin('s.person', 'p')
			->where('p.id = :student')
			->setParameter('student', $person->getId())
			->getQuery()
			->getResult();
		return $result;
	}


	public function findByCareGiverPerson($person)
	{
		$result = $this->createQueryBuilder('f')
			->leftJoin('f.careGiver', 'c')
			->leftJoin('c.person', 'p')
			->where('p.id = :person_id')
			->setParameter('person_id', $person->getId())
			->getQuery()
			->getResult();

		return $result;
	}

}
