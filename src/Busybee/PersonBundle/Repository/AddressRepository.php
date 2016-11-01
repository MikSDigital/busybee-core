<?php

namespace Busybee\PersonBundle\Repository;

use Busybee\PersonBundle\Entity\Address ;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AddressRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * get Locality Choices
	 *
	 * @version	29th October 2016
	 * @since	29th October 2016
	 * @return	array	hint=>value
	 */
	public function getAddressChoices()
	{
		$x = $this->findBy(array(), array('line1' => 'ASC', 'line2' => 'ASC'));
		$result = array();
		foreach ($x as $w)
			$result[$w->getLine1().' '.$w->getLine2()] = $w->getId();
		return $result;
	}

	/**
	 * set Address Locality
	 *
	 * @version	28th October 2016
	 * @since	28th October 2016
	 * @param	integer		$id
	 * @return	array
	 */
	public function setPersonAddress($id)
	{
		if (intval($id) > 0)
			$entity = $this->findOneBy(array('id' => $id));	
		else
			$entity = new Address(); 
		$entity->injectRepository($this);
		return $entity ;			
	}
}