<?php

namespace Busybee\FormBundle\Type ;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType ;
use Symfony\Component\OptionsResolver\OptionsResolver ;
use Symfony\Component\Form\FormInterface ;
use Symfony\Component\Form\AbstractTypeExtension;


class YesNoTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $emptyData = function (FormInterface $form, $viewData) {
            return $viewData;
        };

        $resolver->setDefaults(array(
			'attr'					=> array(
				'data-off-label' 		=> "false",
				'data-on-label' 		=> "false",
				'data-off-icon-cls'	 	=> "glyphicons-thumbs-down",
				'data-on-icon-cls' 		=> "glyphicons-thumbs-up",
				'class'					=> 'yes-no',
			),
			'help' 					=> null,
            'value' 				=> '1',
            'empty_data' 			=> $emptyData,
            'compound' 				=> false,
			'required' 				=> false,
        	)
		);
    }
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return CheckboxType::class;
    }
}