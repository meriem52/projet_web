<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsRoomsController extends AbstractController
{
    #[Route('/details/rooms', name: 'app_details_rooms')]
    public function index(): Response
    {
        return $this->render('details_rooms/index.html.twig', [
            'controller_name' => 'DetailsRoomsController',
        ]);
    }
}
