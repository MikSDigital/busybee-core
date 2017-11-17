<?php

namespace Busybee\Core\TemplateBundle\Extension;

use Symfony\Component\HttpFoundation\File\File;

class ImageExtension extends \Twig_Extension
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'image_twig_extension';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFunctions(): array
	{
		return [
			new \Twig_SimpleFunction('imagePath', array($this, 'imagePath')),
			new \Twig_SimpleFunction('imageExists', array($this, 'imageExists')),
		];
	}

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public function imageExists($value): bool
	{
		if (file_exists($this->imagePath($value)))
			return true;

		return false;
	}

	/**
	 * @param   string|File $value
	 *
	 * @return  string
	 */
	public function imagePath($value): ?string
	{
		if ($value instanceof File)
			return $value->getPathname();

		return $value;
	}
}