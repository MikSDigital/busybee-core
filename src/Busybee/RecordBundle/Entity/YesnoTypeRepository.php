<?php

namespace Busybee\RecordBundle\Entity;

/**
 * YesnoTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class YesnoTypeRepository extends BaseRepository
{
	public function createNew()
	{
		return new YesnoType();
	}
	
	public function findOneBy( array $criteria)
	{
		$result = parent::findOneBy($criteria);
		if (empty($result))
			$result = $this->createNew();
		return $result;
	}
}
