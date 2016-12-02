<?php

namespace Busybee\InstituteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType ;
use Busybee\InstituteBundle\Validator\CalendarStatus ;

class YearType extends AbstractType
{
	private	$statusList ;
	
	public function __construct($list)
	{
		$this->statusList = $list ;
	}
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', null, 
				array(
					'label'	=>	'calendar.label.name',
					'attr'	=>	array(
						'help'	=>	'calendar.help.name',
					),
				)
			)
			->add('start', null, 
				array(
					'label'	=>	'calendar.label.start',
					'attr'	=>	array(
						'help'	=>	'calendar.help.start',
					),
				)
			)
			->add('end', null, 
				array(
					'label'	=>	'calendar.label.end',
					'attr'	=>	array(
						'help'	=>	'calendar.help.end',
					),
				)
			)
			->add('status', ChoiceType::class,
				array(
					'label'	=>	'calendar.label.status',
					'attr'	=>	array(
						'help'	=>	'calendar.help.status',
					),
					'choices'	=> $this->statusList,
					'placeholder'	=> 'calendar.placeholder.status',
					'constraints'	=> array(
						new CalendarStatus(array('id' => is_null($options['data']->getId()) ? 'Add' : $options['data']->getId())),
					),
				)
			)
			->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array(
					'label' 				=> 'form.save',
					'translation_domain' 	=> 'BusybeeHomeBundle',
					'attr' 					=> array(
						'class' 				=> 'btn btn-success glyphicons glyphicons-disk-save',
					),
				)
			)
			->add('cancel', 'Symfony\Component\Form\Extension\Core\Type\ButtonType', array(
					'label'					=> 'form.reset', 
					'translation_domain' 	=> 'BusybeeHomeBundle',
					'attr' 					=> array(
						'formnovalidate' 		=> 'formnovalidate',
						'class' 				=> 'btn btn-info glyphicons glyphicons-remove-circle',
						'onClick'				=> "location.href='".$options['data']->cancelURL."'",
					),
				)
			)
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Busybee\InstituteBundle\Entity\Year',
			'translation_domain' => 'BusybeeInstituteBundle',
			'validation_groups'	=> array('calendar', 'Default'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'calendar_year';
    }


}
