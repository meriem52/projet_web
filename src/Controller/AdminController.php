<?php

namespace App\Controller;

use App\Entity\Admins;
use App\Form\AdminType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(ManagerRegistry $doctrine, Request $request): Response {
        $repository = $doctrine->getRepository(Admins::class);
        $admins = $repository->findAll();
        return $this->render('admin/index.html.twig', ['admins' => $admins]);
    }

    #[Route('/add', name: 'admin.add')]
    public function addAdmin(ManagerRegistry $doctrine, Request $request): Response
    {
        $admin = new Admins();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($admin);
            $em->flush();
            $this->addFlash('success', 'Admin ajouté avec succès !');
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/add-admin.html.twig', ['form' => $form->createView()]);
    }
}
