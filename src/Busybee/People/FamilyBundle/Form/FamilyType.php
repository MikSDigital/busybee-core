<?php

namespace Busybee\People\FamilyBundle\Form;

use Busybee\People\FamilyBundle\Entity\Family;
use Busybee\People\FamilyBundle\Events\FamilySubscriber;
use Busybee\People\FamilyBundle\Model\FamilyManager;
use Busybee\Core\FormBundle\Type\AutoCompleteType;
use Busybee\Core\FormBundle\Type\SettingChoiceType;
use Busybee\People\PersonBundle\Entity\Address;
use Busybee\PersonBundle\Form\PhoneType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamilyType extends AbstractType
{
	/**
	 * @var FamilyManager
	 */
	private $fm;

	public function __construct(FamilyManager $fm)
	{
		$this->fm = $fm;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', null, array(
					'label'    => 'family.label.name',
					'required' => false,
					'attr'     => array(
						'help' => 'family.help.name'
					),
				)
			)
			->add('address1', AutoCompleteType::class,
				array(
					'class'              => Address::class,
					'data'               => $options['data']->getAddress1(),
					'choice_label'       => 'singleLineAddress',
					'empty_data'         => null,
					'required'           => false,
					'label'              => 'person.label.address1',
					'attr'               => array(
						'help'  => 'person.help.address1',
						'class' => 'beeAddressList formChanged',
					),
					'translation_domain' => 'BusybeePersonBundle',
				)
			)
			->add('address2', AutoCompleteType::class,
				array(
					'class'              => Address::class,
					'choice_label'       => 'singleLineAddress',
					'data'               => $options['data']->getAddress2(),
					'empty_data'         => null,
					'required'           => false,
					'label'              => 'person.label.address2',
					'attr'               => array(
						'help'  => 'person.help.address2',
						'class' => 'beeAddressList formChanged',
					),
					'translation_domain' => 'BusybeePersonBundle',
				)
			)
			->add('phone', CollectionType::class, array(
					'label'              => 'person.label.phones',
					'entry_type'         => PhoneType::class,
					'allow_add'          => true,
					'by_reference'       => false,
					'allow_delete'       => true,
					'attr'               => array(
						'class' => 'phoneNumberList'
					),
					'translation_domain' => 'BusybeePersonBundle',
					'required'           => false,
				)
			)
			->add('careGiver', CollectionType::class, array(
					'label'        => 'family.label.caregiver',
					'entry_type'   => CareGiverType::class,
					'allow_add'    => true,
					'by_reference' => false,
					'allow_delete' => true,
					'attr'         => array(
						'class' => 'careGiverList',
						'help'  => 'family.help.caregiver',
					),
					'required'     => false,
				)
			)
			->add('students', CollectionType::class, array(
					'label'        => 'family.label.students',
					'entry_type'   => StudentType::class,
					'allow_add'    => true,
					'by_reference' => false,
					'allow_delete' => true,
					'attr'         => array(
						'class' => 'studentList',
						'help'  => 'family.help.students',
					),
					'required'     => false,
				)
			)
			->add('firstLanguage', LanguageType::class, array(
					'label'       => 'family.label.language.first',
					'placeholder' => 'family.placeholder.language',
					'required'    => false,
				)
			)
			->add('secondLanguage', LanguageType::class, array(
					'label'       => 'family.label.language.second',
					'placeholder' => 'family.placeholder.language',
					'required'    => false,
				)
			)
			->add('house', SettingChoiceType::class, array(
					'label'        => 'family.label.house',
					'placeholder'  => 'family.placeholder.house',
					'required'     => false,
					'attr'         => array(
						'help' => 'family.help.house',
					),
					'setting_name' => 'house.list',
				)
			);
		$builder->addEventSubscriber(new FamilySubscriber($this->fm));

	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'         => Family::class,
			'translation_domain' => 'BusybeeFamilyBundle',
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'family';
	}


}