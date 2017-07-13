<?php

namespace Busybee\SecurityBundle\Model;

use Busybee\SecurityBundle\Entity\Page;
use Busybee\SecurityBundle\Repository\PageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;

class PageManager
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var array
     */
    private $pageSecurity;

    /**
     * @var Page
     */
    private $page;

    /**
     * @var Router
     */
    private $router;

    /**
     * PageManager constructor.
     * @param Session $session
     * @param ObjectManager $om
     * @param RequestStack $request
     */
    public function __construct(Session $session, ObjectManager $om, Router $router)
    {
        $this->session = $session;
        $this->pageRepository = $om->getRepository(Page::class);
        $this->om = $om;
        $this->router = $router;
    }

    /**
     * Find One by Route
     *
     * @param string $routeName
     * @param array|string $attributes
     * @return Page
     */
    public function findOneByRoute(string $routeName, $attributes = []): Page
    {
        $this->pageSecurity = $this->session->get('pageSecurity');

        if (!is_array($this->pageSecurity))
            $this->pageSecurity = [];

        $this->page = empty($this->pageSecurity[$routeName]) ? null : $this->pageSecurity[$routeName];

        if (!is_array($attributes))
            $attributes = [$attributes];

        if (empty($this->page)) {
            $this->page = $this->pageRepository->findOneByRoute($routeName);
            $this->pageSecurity[$routeName] = $this->page;
        }

        foreach ($attributes as $attribute)
            $this->page->addRole($attribute);

        if (empty($this->page->getId())) {

            $this->page->setPath($this->router->getRouteCollection()->get($routeName)->getPath());
            $this->page->setCacheTime();
            $this->om->persist($this->page);
            $this->om->flush();
            $this->pageSecurity[$routeName] = $this->page;
        }

        if ($this->page->getCacheTime() < new \DateTime('-15 Minutes')) {
            $this->page = $this->pageRepository->find($this->page->getId());
            foreach ($attributes as $attribute)
                $this->page->addRole($attribute);

            if (empty($this->page->getId()))
                $this->page->setPath($this->router->getRouteCollection()->get($routeName)->getPath());

            $this->page->setCacheTime();
            $this->om->persist($this->page);
            $this->om->flush();
            $this->pageSecurity[$routeName] = $this->page;
        }

        $this->session->set('pageSecurity', $this->pageSecurity);

        return $this->page;
    }
}