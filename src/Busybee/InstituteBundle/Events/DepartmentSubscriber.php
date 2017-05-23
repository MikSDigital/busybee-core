<?php

namespace Busybee\InstituteBundle\Events;

use Busybee\InstituteBundle\Form\DepartmentStaffType;
use Busybee\SystemBundle\Setting\SettingManager;
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
     * DepartmentType constructor.
     * @param SettingManager $om
     */
    public function __construct(SettingManager $sm)
    {
        $this->sm = $sm;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit',
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();


        if (isset($data['courses']) && is_array($data['courses'])) {
            $items = [];
            foreach ($data['courses'] as $q => $w)
                if (!in_array($w, $items))
                    $items[$q] = $w;
            $data['courses'] = $items;
        }
        if (isset($data['staff']) && is_array($data['staff'])) {
            $items = [];
            foreach ($data['staff'] as $q => $w)
                if (!in_array($w['staff'], $items))
                    $items[$q] = $w['staff'];
                else
                    unset($data['staff'][$q]);
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

        if (!is_null($data->getType())) {

            $form->add('staff', CollectionType::class,
                [
                    'entry_type' => DepartmentStaffType::class,
                    'attr' =>
                        [
                            'class' => 'staffList',
                            'help' => 'department.help.staff',
                        ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => [
                        'staff_type' => $data->getType(),
                    ],
                ]);
        }
    }
}