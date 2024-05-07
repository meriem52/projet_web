<?php

namespace App\Controller\admin;

use App\Entity\Chambres;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/room')]
class RoomController extends AbstractController
{
    #[Route('/', name: 'admin_room_index', methods: ['GET'])]
    public function index(RoomRepository $roomRepository): Response
    {
        $rooms = $roomRepository->findAll();

        return $this->render('admin/room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }

    #[Route('/new/{id}', name: 'admin_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, $id): Response
    {
        $room = new Chambres();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // File upload
            $file = $form['image']->getData();
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                    $room->setImage($fileName);
                } catch (FileException $e) {
                    // Handle file upload error
                }
            }

            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('admin_room_new', ['id'=> $id]);
        }

        return $this->render('admin/room/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_room_show', methods: ['GET'])]
    public function show(Chambres $room): Response
    {
        return $this->render('admin/room/show.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/{id}/edit/{hid}', name: 'admin_room_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, Chambres $room): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // File upload
            $file = $form['image']->getData();
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                    $room->setImage($fileName);
                } catch (FileException $e) {
                    // Handle file upload error
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin_room_new', ['id'=> $id]);
        }

        return $this->render('admin/room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/{hid}', name: 'admin_room_delete', methods: ['DELETE'])]
    public function delete(Request $request, $id, Chambres $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_room_new', ['id'=> $id]);
    }
}
