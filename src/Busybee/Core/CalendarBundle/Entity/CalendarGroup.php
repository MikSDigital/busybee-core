<?php

namespace Busybee\Core\CalendarBundle\Entity;

use Busybee\Core\CalendarBundle\Model\CalendarGroupModel;
use Busybee\Facility\InstituteBundle\Entity\Space;
use Busybee\People\StaffBundle\Entity\Staff;
use Busybee\People\StudentBundle\Entity\StudentCalendarGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

/**
 * Calendar Group
 */
class CalendarGroup extends CalendarGroupModel
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $nameShort;

	/**
	 * @var \Busybee\Core\CalendarBundle\Entity\Year
	 */
	private $year;

	/**
	 * @var \Busybee\Core\SecurityBundle\Entity\User
	 */
	private $createdBy;

	/**
	 * @var \Busybee\Core\SecurityBundle\Entity\User
	 */
	private $modifiedBy;

	/**
	 * @var integer
	 */
	private $sequence;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var \DateTime
	 */
	private $lastModified;

	/**
	 * @var \DateTime
	 */
	private $createdOn;

	/**
	 * @var ArrayCollection
	 */
	private $students;

	/**
	 * @var Staff
	 */
	private $yearTutor;

	/**
	 * @var string
	 */
	private $website;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->students = new ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get nameShort
	 *
	 * @return string
	 */
	public function getNameShort(): ?string
	{
		return $this->nameShort;
	}

	/**
	 * Set nameShort
	 *
	 * @param string $nameShort
	 *
	 * @return CalendarGroup
	 */
	public function setNameShort($nameShort): CalendarGroup
	{
		$this->nameShort = $nameShort;

		return $this;
	}

	/**
	 * Get year
	 *
	 * @return Year
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * Set year
	 *
	 * @param Year $year
	 *
	 * @return CalendarGroup
	 */
	public function setYear(Year $year = null)
	{
		$this->year = $year;

		return $this;
	}

	/**
	 * Get lastModified
	 *
	 * @return \DateTime
	 */
	public function getLastModified()
	{
		return $this->lastModified;
	}

	/**
	 * Set lastModified
	 *
	 * @param \DateTime $lastModified
	 *
	 * @return Department
	 */
	public function setLastModified($lastModified)
	{
		$this->lastModified = $lastModified;

		return $this;
	}

	/**
	 * Get createdOn
	 *
	 * @return \DateTime
	 */
	public function getCreatedOn()
	{
		return $this->createdOn;
	}

	/**
	 * Set createdOn
	 *
	 * @param \DateTime $createdOn
	 *
	 * @return Department
	 */
	public function setCreatedOn($createdOn)
	{
		$this->createdOn = $createdOn;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \Busybee\Core\SecurityBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set createdBy
	 *
	 * @param \Busybee\Core\SecurityBundle\Entity\User $createdBy
	 *
	 * @return CalendarGroup
	 */
	public function setCreatedBy(\Busybee\Core\SecurityBundle\Entity\User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get modifiedBy
	 *
	 * @return \Busybee\Core\SecurityBundle\Entity\User
	 */
	public function getModifiedBy()
	{
		return $this->modifiedBy;
	}

	/**
	 * Set modifiedBy
	 *
	 * @param \Busybee\Core\SecurityBundle\Entity\User $modifiedBy
	 *
	 * @return CalendarGroup
	 */
	public function setModifiedBy(\Busybee\Core\SecurityBundle\Entity\User $modifiedBy = null)
	{
		$this->modifiedBy = $modifiedBy;

		return $this;
	}

	/**
	 * Get sequence
	 *
	 * @return integer
	 */
	public function getSequence()
	{
		return $this->sequence;
	}

	/**
	 * Set sequence
	 *
	 * @param integer $sequence
	 *
	 * @return CalendarGroup
	 */
	public function setSequence($sequence)
	{
		$this->sequence = $sequence;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		if (empty($this->name))
			return $this->nameShort;

		return $this->name;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return CalendarGroup
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get Students
	 *
	 * @return Collection
	 */
	public function getStudents()
	{
		return $this->students;
	}

	/**
	 * Set Students
	 *
	 * @param ArrayCollection $students
	 *
	 * @return CalendarGroup
	 */
	public function setStudents(ArrayCollection $students): CalendarGroup
	{
		$this->students = $students;

		return $this;
	}

	/**
	 * Add Student
	 *
	 * @param StudentCalendarGroup|null $student
	 *
	 * @return CalendarGroup
	 */
	public function addStudent(StudentCalendarGroup $student = null, $add = true): CalendarGroup
	{
		if (!$student instanceof StudentCalendarGroup)
			return $this;

		if ($add)
			$student->setCalendarGroup($this, false);

		if (!$this->students->contains($student))
			$this->students->add($student);

		return $this;
	}

	/**
	 * Remove Student
	 *
	 * @param StudentCalendarGroup $student
	 *
	 * @return CalendarGroup
	 */
	public function removeStudent(StudentCalendarGroup $student): CalendarGroup
	{
		$this->students->removeElement($student);

		return $this;
	}

	/**
	 * @return Staff|null
	 */
	public function getYearTutor(): ?Staff
	{
		return $this->yearTutor;
	}

	/**
	 * @param Staff $yearTutor
	 *
	 * @return CalendarGroup
	 */
	public function setYearTutor(Staff $yearTutor = null): CalendarGroup
	{
		$this->yearTutor = $yearTutor;

		return $this;
	}
	/**
	 * @return string|null
	 */
	public function getWebsite(): ?string
	{
		return $this->website;
	}

	/**
	 * @param string|null $website
	 *
	 * @return CalendarGroup
	 */
	public function setWebsite(string $website = null): CalendarGroup
	{
		$this->website = $website;

		return $this;
	}

}
