<?php

namespace Busybee\Program\CurriculumBundle\Controller;

use Busybee\Program\CurriculumBundle\Entity\Course;
use Busybee\Program\CurriculumBundle\Form\CourseType;
use Busybee\Core\TemplateBundle\Controller\BusybeeController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class CourseController extends BusybeeController
{


	/**
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, null);

		$up = $this->get('course.pagination');

		$up->injectRequest($request);

		$up->getDataSet();

		return $this->render('BusybeeCurriculumBundle:Course:index.html.twig', array('pagination' => $up));
	}

	/**
	 * @param         $id
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editAction($id, Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, null);

		$entity = new Course();

		$id = $request->get('id');
		if (intval($id) > 0)
			$entity = $this->get('course.repository')->find($id);

		$form = $this->createForm(CourseType::class, $entity);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->get('doctrine')->getManager();

			$em->persist($entity);
			$em->flush();

			return new RedirectResponse($this->get('router')->generate('course_edit', array('id' => $entity->getId())));
		}

		return $this->render('BusybeeCurriculumBundle:Course:edit.html.twig', array('id' => $id, 'form' => $form->createView()));
	}
}
