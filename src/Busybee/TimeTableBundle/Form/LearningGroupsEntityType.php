<?php

namespace Busybee\TimeTableBundle\Form;

use Busybee\TimeTableBundle\Entity\LearningGroups;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LearningGroupsEntityType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => null,
                'translation_domain' => 'BusybeeTimeTableBundle',
                'placeholder' => 'timetable.line.placeholder.learningGroups',
                'class' => LearningGroups::class,
                'choice_label' => 'name',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tt_line_lgs';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return EntityType::class;
    }

}
