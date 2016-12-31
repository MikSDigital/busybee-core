<?php

namespace Busybee\InstituteBundle\Controller ;

use Busybee\InstituteBundle\Entity\HomeRoom;
use Busybee\InstituteBundle\Form\HomeRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request ;


class HomeRoomController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
		$this->denyAccessUnlessGranted('ROLE_REGISTRAR', null, 'Unable to access this page!');

        $up = $this->get('HomeRoom.pagination');

        $up->injectRequest($request);

        $up->getDataSet();

        return $this->render('BusybeeInstituteBundle:HomeRoom:index.html.twig', array('pagination' => $up));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_REGISTRAR', null, 'Unable to access this page!');

        $entity = new HomeRoom();

        $id = $request->get('id');
        if (intval($id) > 0)
            $entity = $this->get('HomeRoom.repository')->find($id);

        if (! is_null($entity->getSchoolYear())) $entity->getSchoolYear()->getName();
        if (! is_null($entity->getCampusResource())) $entity->getCampusResource()->getName();
        if (! is_null($entity->getTutor1())) $entity->getTutor1()->getPerson();
        if (! is_null($entity->getTutor2())) $entity->getTutor2()->getPerson();
        if (! is_null($entity->getTutor2())) $entity->getTutor2()->getPerson();

        $entity->cancelURL = $this->get('router')->generate('home_room_manage');

        $form = $this->createForm(HomeRoomType::class, $entity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->get('doctrine')->getManager();

            $em->persist($entity);
            $em->flush();

            return new RedirectResponse($this->get('router')->generate('home_room_edit', array('id' => $entity->getId())));
        }

        return $this->render('BusybeeInstituteBundle:HomeRoom:edit.html.twig', array('id' => $id, 'form' => $form->createView()));
    }
}