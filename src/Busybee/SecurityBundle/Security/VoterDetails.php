<?php

namespace Busybee\SecurityBundle\Security;

use Busybee\StaffBundle\Entity\Staff;
use Busybee\StudentBundle\Entity\Student;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class VoterDetails
{
    /**
     * @var ArrayCollection
     */
    private $grades;

    /**
     * @var Student
     */
    private $student;

    /**
     * @var Staff
     */
    private $staff;

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * VoterDetails constructor.
     */
    public function __construct(ObjectManager $om)
    {
        $this->grades = new ArrayCollection();
        $this->student = null;
        $this->om = $om;
    }

    public function parseIdentifier($identifier)
    {
        $this->addGrade($identifier)
            ->addStudent($identifier)
            ->addSTaff($identifier);

        return $this;
    }

    /**
     * Add Student
     *
     * @param int $id
     * @return VoterDetails
     */
    public function addStaff($staff): VoterDetails
    {
        if (substr($staff, 0, 4) !== 'staf')
            return $this->setStaff(null);

        $id = intval(substr($staff, 4));

        if (gettype($id) !== 'integer' || empty($id))
            return $this->setStaff(null);

        $staff = $this->om->getRepository(Staff::class)->find($id);
        if ($staff instanceof Staff)
            $this->setStaff($staff);

        return $this;
    }

    /**
     * Add Student
     *
     * @param int $id
     * @return VoterDetails
     */
    public function addStudent($student): VoterDetails
    {
        if (substr($student, 0, 4) !== 'stud')
            return $this->setStudent(null);

        $id = intval(substr($student, 4));

        if (gettype($id) !== 'integer' || empty($id))
            return $this->setStudent(null);

        $student = $this->om->getRepository(Student::class)->find($id);
        if ($student instanceof Student)
            $this->setStudent($student);

        return $this;
    }

    /**
     * Add Grade
     *
     * @param string $grade
     * @return VoterDetails
     */
    public function addGrade($grade): VoterDetails
    {
        if (substr($grade, 0, 4) !== 'grad')
            return $this;

        if ($this->grades->contains($grade))
            return $this;

        $this->grades->add($grade);
        return $this;
    }

    /**
     * Remove Grade
     *
     * @param string $grade
     * @return VoterDetails
     */
    public function removeGrade($grade): VoterDetails
    {
        $this->grades->removeElement($grade);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getGrades(): ArrayCollection
    {
        return $this->grades;
    }

    /**
     * Get Student
     *
     * @return null
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set Student
     *
     * @param Student $student
     * @return VoterDetails
     */
    public function setStudent(Student $student = null): VoterDetails
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get Student
     *
     * @return null
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set Student
     *
     * @param Student $student
     * @return VoterDetails
     */
    public function setStaff(Staff $staff = null): VoterDetails
    {
        $this->staff = $staff;

        return $this;
    }
}