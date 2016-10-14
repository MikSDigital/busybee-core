<?php

namespace Busybee\RecordBundle\Entity;

/**
 * StringRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParentTypeRepository extends BaseRepository
{
	public function createNew()
	{
		$record = new ParentType();
		$record->setCreatedOn(new \DateTime('now'));
		return $record ;
	}
	
	public function findOneBy( array $criteria)
	{
		$result = parent::findOneBy($criteria);
		if (empty($result))
			$result = $this->createNew();
		return $result;
	}
}
