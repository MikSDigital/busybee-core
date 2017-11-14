<?php

namespace Busybee\Facility\InstituteBundle\Events;

use Busybee\Facility\InstituteBundle\Form\DepartmentMemberType;
use Busybee\Core\SystemBundle\Setting\SettingManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DepartmentSubscriber implements EventSubscriberInterface
{
	/**
	 * @var SettingManager
	 */
	private $sm;

	/**
	 * @varObjectManager
	 */
	private $om;

	/**
	 * DepartmentType constructor.
	 *
	 * @param SettingManager $om
	 */
	public function __construct(SettingManager $sm, ObjectManager $om)
	{
		$this->sm = $sm;
		$this->om = $om;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		// Tells the dispatcher that you want to listen on the form.pre_set_data
		// event and that the preSetData method should be called.
		return array(
			FormEvents::PRE_SUBMIT   => 'preSubmit',
			FormEvents::PRE_SET_DATA => 'preSetData',
		);
	}

	/**
	 * @param FormEvent $event
	 */
	public function preSubmit(FormEvent $event)
	{
		$data = $event->getData();
		$dept = $event->getForm()->getData();


		if (isset($data['courses']) && is_array($data['courses']))
		{
			$items = [];
			foreach ($data['courses'] as $q => $w)
				if (!in_array($w, $items))
					$items[$q] = $w;
			$data['courses'] = $items;
		}

		$event->setData($data);
	}

	/**
	 * @param FormEvent $event
	 */
	public function preSetData(FormEvent $event)
	{
		$data = $event->getData();
		$form = $event->getForm();

		if (!is_null($data->getType()))
		{

			$form->add('members', CollectionType::class,
				[
					'entry_type'    => DepartmentMemberType::class,
					'attr'          =>
						[
							'class' => 'memberList',
							'help'  => 'department.members.help',
						],
					'allow_add'     => true,
					'allow_delete'  => true,
					'entry_options' => [
						'staff_type' => $data->getType(),
					],
				]);
		}
	}
}