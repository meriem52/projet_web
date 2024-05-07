<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambresController extends AbstractController
{
    #[Route('/chambres', name: 'app_admin_chambres')]
    public function chambres(): Response
    {
        return $this->render('chambres/index.html.twig');
    }
}
