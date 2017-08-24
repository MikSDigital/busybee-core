<?php

namespace Busybee\People\StaffBundle\Security;

use Busybee\People\PersonBundle\Model\PersonManager;
use Busybee\SecurityBundle\Entity\User;
use Busybee\SecurityBundle\Security\VoterDetails;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class StudentVoter extends Voter
{
	/**
	 * @var AccessDecisionManagerInterface
	 */
	private $decisionManager;

	/**
	 * @var PersonManager
	 */
	private $personManager;

	/**
	 * GradeVoter constructor.
	 *
	 * @param AccessDecisionManagerInterface $decisionManager
	 */
	public function __construct(AccessDecisionManagerInterface $decisionManager, PersonManager $personManager)
	{
		$this->decisionManager = $decisionManager;
		$this->personManager   = $personManager;
	}

	/**
	 * @param string $attribute
	 * @param mixed  $subject
	 *
	 * @return bool
	 */
	protected function supports($attribute, $subject)
	{

		if (!$subject instanceof VoterDetails)
			return false;

		if (is_null($subject->getStudent()))
			return false;

		return true;
	}

	/**
	 * @param string         $attribute
	 * @param mixed          $subject
	 * @param TokenInterface $token
	 *
	 * @return bool
	 */
	protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
	{
		if (!$this->decisionManager->decide($token, array('ROLE_TEACHER')))
			return false;

		$user = $token->getUser();

		if (!$user instanceof User)
			return false;

		if (!$this->personManager->isStaff($user->getPerson()))
			return false;

		return $this->personManager->isTeacherOf($user->getPerson()->getStaff(), $subject->getStudent());
	}
}