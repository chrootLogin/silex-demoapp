<?php

namespace rootLogin\DemoApp\Controller;

use Doctrine\ORM\EntityRepository;
use Silex\Application;
use Saxulum\DoctrineOrmManagerRegistry\Doctrine\ManagerRegistry;
use Saxulum\RouteController\Annotation\DI;
use Saxulum\RouteController\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * @DI(serviceIds={"doctrine", "twig", "url_generator"})
 */
class ExampleController
{
    /**
     * @var ManagerRegistry
     */
    protected $doctrine;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * @param ManagerRegistry $doctrine
     * @param \Twig_Environment $twig
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(
        ManagerRegistry $doctrine,
        \Twig_Environment $twig,
        UrlGenerator $urlGenerator
    ) {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/", bind="home")
     * @return string
     */
    public function listAction(Request $request)
    {
        return new Response(
            $this->twig->render("@rootLoginDemoApp/index.html.twig")
        );
    }
}