<?php
namespace Busybee\SecurityBundle\Controller;

use Busybee\SecurityBundle\Form\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

class PageController extends Controller
{
    use \Busybee\SecurityBundle\Security\DenyAccessUnlessGranted ;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_SYSTEM_ADMIN', new \stdClass());

        $up = $this->get('security.page.pagination');

        $up->injectRequest($request);

        $up->getDataSet();

        return $this->render('BusybeeSecurityBundle:Page:index.html.twig',
            array(
                'pagination' => $up,
            )
        );
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_SYSTEM_ADMIN');

        $page = $this->get('security.page.repository')->find($id);

        if (empty($page))
            throw new InvalidArgumentException($this->get('translator')->trans('security.page.missing', array('%id%'=>$id), 'BusybeeSecurityBundle'));

        $page->cancelURL = $this->generateUrl('page_list') ;

        $form = $this->createForm(PageType::class, $page);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'security.page.save.success');
        }

        return $this->render('BusybeeSecurityBundle:Page:edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }
}
