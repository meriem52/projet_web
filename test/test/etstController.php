<?php

declare(strict_types=1);

namespace test\test;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class etstController extends AbstractController
{

    /**
     * @Route("/etst")
     */
    public function index(): Response
    {
        return $this->render('etst/index.html.twig');
    }
}
