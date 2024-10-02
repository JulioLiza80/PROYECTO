<?php

namespace App\Controller;

use App\Entity\Campanias;
use App\Form\CampaniasType;
use App\Repository\CampaniasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/campanias')]
final class CampaniasController extends AbstractController
{
    #[Route(name: 'app_campanias_index', methods: ['GET'])]
    public function index(CampaniasRepository $campaniasRepository): Response
    {
        return $this->render('campanias/index.html.twig', [
            'campanias' => $campaniasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_campanias_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $campania = new Campanias();
        $form = $this->createForm(CampaniasType::class, $campania);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($campania);
            $entityManager->flush();

            return $this->redirectToRoute('app_campanias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campanias/new.html.twig', [
            'campania' => $campania,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_campanias_show', methods: ['GET'])]
    public function show(Campanias $campania): Response
    {
        return $this->render('campanias/show.html.twig', [
            'campania' => $campania,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_campanias_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campanias $campania, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CampaniasType::class, $campania);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_campanias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campanias/edit.html.twig', [
            'campania' => $campania,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_campanias_delete', methods: ['POST'])]
    public function delete(Request $request, Campanias $campania, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campania->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($campania);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_campanias_index', [], Response::HTTP_SEE_OTHER);
    }
}
