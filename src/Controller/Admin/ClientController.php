<?php
namespace App\Controller\Admin;

use App\Entity\Clients;
use App\Form\ClientType;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/client")
 */
class ClientController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="admin_user_index", methods={"GET"})
     */
    public function index(ClientsRepository $clientsRepository): Response
    {
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clients = new Clients();
        $form = $this->createForm(ClientType::class, $clients);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($clients);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/client/new.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_show", methods={"GET"})
     */
    public function show(Clients $clients): Response
    {
        return $this->render('admin/client/show.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clients $clients): Response
    {
        $form = $this->createForm(ClientType::class, $clients);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/client/edit.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Clients $clients): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clients->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($clients);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index');
    }
}