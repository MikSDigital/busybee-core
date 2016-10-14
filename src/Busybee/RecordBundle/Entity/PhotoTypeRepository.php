<?php

namespace Busybee\RecordBundle\Entity;

/**
 * StringRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoTypeRepository extends BaseRepository
{
	public function createNew()
	{
		$record = new PhotoType();
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
