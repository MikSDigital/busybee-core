<?php

namespace Busybee\ActivityBundle\Controller;

use Busybee\ActivityBundle\Entity\Activity;
use Busybee\ActivityBundle\Form\ActivityType;
use Busybee\Core\TemplateBundle\Controller\BusybeeController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends BusybeeController
{


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $up = $this->get('activity.pagination');

        $up->injectRequest($request);

        $up->getDataSet();

        return $this->render('BusybeeActivityBundle:Activity:list.html.twig',
            array(
                'pagination' => $up,
                'am' => $this->get('activity.manager'),
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id, $closeWindow)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $this->get('doctrine')->getManager();

        $entity = intval($id) > 0 ? $this->get('activity.repository')->find($id) : new Activity();

	    $entity->setYear($this->get('busybee_core_calendar.model.get_current_year'));

        $editOptions = array();

	    $form = $this->createForm(ActivityType::class, $entity, ['year_data' => $this->get('busybee_core_calendar.model.get_current_year')]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();

            if ($id === 'Add') {
                $close = [];
                if (!empty($closeWindow))
                    $close = ['closeWindow' => '_closeWindow'];

                $id = $entity->getId();
                return new RedirectResponse($this->generateUrl('activity_edit', array_merge(['id' => $id], $close)));
            }
        }

        $editOptions['id']       = $id;
        $editOptions['form']     = $form->createView();
        $editOptions['fullForm'] = $form;
	    $editOptions['manager']  = $this->get('busybee_people_student.model.student_manager');

        return $this->render('BusybeeActivityBundle:Activity:edit.html.twig',
            $editOptions
        );
    }

    public function studentListAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $activity = $this->get('activity.repository')->find($id);

        $data = empty($activity) || empty($activity->getStudents()) ? [] : $activity->getStudents()->toArray();

        $students = [];
        foreach ($data as $student)
            $students[] = $student->getId();

        return new JsonResponse(
            array(
                'students' => json_encode($students),
                'status' => 'success',
            ),
            200
        );
    }

    /**
     * @param $id
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $this->get('activity.manager')->deleteActivity($id);

        return new RedirectResponse($this->generateUrl('activity_list'));
    }
}