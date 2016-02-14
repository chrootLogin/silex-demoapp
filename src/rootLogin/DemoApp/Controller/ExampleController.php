<?php

namespace rootLogin\DemoApp\Controller;

use Silex\Application;
use Saxulum\RouteController\Annotation\DI;
use Saxulum\RouteController\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @DI(serviceIds={"twig"})
 */
class ExampleController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(
        \Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    /**
     * @Route("/", bind="home")
     * @return string
     */
    public function homeAction(Request $request)
    {
        return new Response(
            $this->twig->render("@rootLoginDemoApp/index.html.twig")
        );
    }
}