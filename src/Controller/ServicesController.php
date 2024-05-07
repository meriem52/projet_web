<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// src/Controller/ServicesController.php



class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(): Response
    {

        // Dans votre contrôleur Symfony
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController', // Définissez la valeur appropriée
        ]);

    }
}
