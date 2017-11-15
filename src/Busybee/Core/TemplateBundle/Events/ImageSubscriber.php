<?php

namespace Busybee\Core\TemplateBundle\Events;

use Busybee\Core\SystemBundle\Setting\SettingManager;
use Busybee\Core\TemplateBundle\Type\ChoiceSettingType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Translation\TranslatorInterface;

class ImageSubscriber implements EventSubscriberInterface
{
	/**
	 * @var string
	 */
	private $targetDir;

	/**
	 * ImageSubscriber constructor.
	 *
	 * @param string $targetDir
	 */
	public function __construct(string $targetDir)
	{
		$this->targetDir = $targetDir;
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
		);
	}

	/**
	 * @param FormEvent $event
	 */
	public function preSubmit(FormEvent $event)
	{
		$form = $event->getForm();
		$data = $event->getData();

		if ($data instanceof UploadedFile)
		{

			dump($this);
			dump($data);
			dump($form->getConfig()->getOption('fileName'));
			$fName = $form->getConfig()->getOption('fileName') . '_' . mb_substr(md5(uniqid()), mb_strlen($form->getConfig()->getOption('fileName')) + 1) . '.' . $data->guessExtension();
			dump($fName);
			$path = $this->targetDir;
			$data->move($path, $fName);

			$file = new File($path . DIRECTORY_SEPARATOR . $fName, true);

			$data = $file->getPathName();
			dump($data);

		}

		if (!empty($form->getData()) && empty($data))
			$data = $form->getData();

		$event->setData($data);

	}
}