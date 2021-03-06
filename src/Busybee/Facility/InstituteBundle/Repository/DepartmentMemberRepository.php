<?php
namespace Busybee\Facility\InstituteBundle\Repository;

use Busybee\People\StaffBundle\Entity\Staff;

/**
 * DepartmentMemberRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DepartmentMemberRepository extends \Doctrine\ORM\EntityRepository
{
	public function findByStaffCoordinator(Staff $staff)
	{
		return $this->createQueryBuilder('d')
			->leftJoin('d.staff', 's')
			->where('s.id = :staff_id')
			->setParameter('staff_id', $staff->getId())
			->andWhere('d.staffType LIKE :staffType')
			->setParameter('staffType', '%Coordinator%')
			->getQuery()
			->getResult();
	}
}
