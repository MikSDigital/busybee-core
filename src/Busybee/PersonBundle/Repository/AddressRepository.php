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
		$x = $this->findBy(array(), array('propertyName' => 'ASC', 'streetName' => 'ASC'));
		$result = array();
		foreach ($x as $w) 
		{
			$key = trim($w->getPropertyName().' '.$w->getBuildingType().' '.$w->getBuildingNumber().'/'.$w->getStreetNumber().' '.$w->getStreetName(), ' /');
			$result[$key] = $w->getId();
		}
		return $result;
	}

}
