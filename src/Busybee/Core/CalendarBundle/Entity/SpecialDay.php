<?php

namespace Busybee\Core\CalendarBundle\Entity;

use Busybee\Core\CalendarBundle\Model\SpecialDay as SpecialDayModel;

/**
 * SpecialDay
 */
class SpecialDay extends SpecialDayModel
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var \DateTime
	 */
	private $day;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var \DateTime
	 */
	private $open;

	/**
	 * @var \DateTime
	 */
	private $start;

	/**
	 * @var \DateTime
	 */
	private $finish;

	/**
	 * @var \DateTime
	 */
	private $close;

	/**
	 * @var \DateTime
	 */
	private $lastModified;

	/**
	 * @var \DateTime
	 */
	private $createdOn;

	/**
	 * @var \Busybee\SecurityBundle\Entity\User
	 */
	private $createdBy;

	/**
	 * @var \Busybee\SecurityBundle\Entity\User
	 */
	private $modifiedBy;

	/**
	 * @var \Busybee\Core\CalendarBundle\Entity\Year
	 */
	private $year;


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
	 * Get day
	 *
	 * @return \DateTime
	 */
	public function getDay()
	{
		return $this->day;
	}

	/**
	 * Set day
	 *
	 * @param \DateTime $day
	 *
	 * @return SpecialDay
	 */
	public function setDay($day)
	{
		$this->day = $day;

		return $this;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set type
	 *
	 * @param string $type
	 *
	 * @return SpecialDay
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SpecialDay
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return SpecialDay
	 */
	public function setDescription($description)
	{
		$this->description = $description;

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
	 * @return SpecialDay
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
	 * @return SpecialDay
	 */
	public function setCreatedOn($createdOn)
	{
		$this->createdOn = $createdOn;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return \Busybee\SecurityBundle\Entity\User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set createdBy
	 *
	 * @param \Busybee\SecurityBundle\Entity\User $createdBy
	 *
	 * @return SpecialDay
	 */
	public function setCreatedBy(\Busybee\SecurityBundle\Entity\User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get modifiedBy
	 *
	 * @return \Busybee\SecurityBundle\Entity\User
	 */
	public function getModifiedBy()
	{
		return $this->modifiedBy;
	}

	/**
	 * Set modifiedBy
	 *
	 * @param \Busybee\SecurityBundle\Entity\User $modifiedBy
	 *
	 * @return SpecialDay
	 */
	public function setModifiedBy(\Busybee\SecurityBundle\Entity\User $modifiedBy = null)
	{
		$this->modifiedBy = $modifiedBy;

		return $this;
	}

	/**
	 * Get year
	 *
	 * @return \Busybee\Core\CalendarBundle\Entity\Year
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * Set year
	 *
	 * @param \Busybee\Core\CalendarBundle\Entity\Year $year
	 *
	 * @return SpecialDay
	 */
	public function setYear(\Busybee\Core\CalendarBundle\Entity\Year $year = null)
	{
		$this->year = $year;

		return $this;
	}

	/**
	 * Get open
	 *
	 * @return \DateTime
	 */
	public function getOpen()
	{
		return $this->open;
	}

	/**
	 * Set open
	 *
	 * @param \DateTime $open
	 *
	 * @return SpecialDay
	 */
	public function setOpen($open)
	{
		$this->open = $open;

		return $this;
	}

	/**
	 * Get start
	 *
	 * @return \DateTime
	 */
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * Set start
	 *
	 * @param \DateTime $start
	 *
	 * @return SpecialDay
	 */
	public function setStart($start)
	{
		$this->start = $start;

		return $this;
	}

	/**
	 * Get finish
	 *
	 * @return \DateTime
	 */
	public function getFinish()
	{
		return $this->finish;
	}

	/**
	 * Set finish
	 *
	 * @param \DateTime $finish
	 *
	 * @return SpecialDay
	 */
	public function setFinish($finish)
	{
		$this->finish = $finish;

		return $this;
	}

	/**
	 * Get close
	 *
	 * @return \DateTime
	 */
	public function getClose()
	{
		return $this->close;
	}

	/**
	 * Set close
	 *
	 * @param \DateTime $close
	 *
	 * @return SpecialDay
	 */
	public function setClose($close)
	{
		$this->close = $close;

		return $this;
	}
}
