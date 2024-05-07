<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/user', name: 'app_admin_user')]
    public function user(): Response
    {
        return $this->render('client/index.html.twig');
    }
}
