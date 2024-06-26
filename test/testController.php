<?php

declare(strict_types=1);

namespace test;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController
{

    /**
     * @Route("/test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig');
    }
}
