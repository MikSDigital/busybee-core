<?php

namespace Busybee\RecordBundle\Entity;

/**
 * RecordRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecordRepository extends BaseRepository
{
	public function getNextRecord($table)
	{
		$result = $this->createQueryBuilder('a')
			->select('a.record')
			->where('a.table = :table_id')
			->addOrderBy('a.record' , 'Desc')
			->setParameter('table_id', $table->getId())
			->setFirstResult( 0 )
			->setMaxResults( 1 )
			->getQuery()
			->getResult();
		if (empty($result))
			$rec_id = 1;
		else
			$rec_id = intval($result[0]['record'] + 1);
		return $rec_id;
	}

	public function createNew()
	{
		$record = new Record();
		$record->setCreatedOn(new \DateTime('now'));
		return $record ;
	}

}
