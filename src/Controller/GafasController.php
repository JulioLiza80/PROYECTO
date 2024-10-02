<?php

namespace App\Controller;

use App\Entity\Gafas;
use App\Form\GafasType;
use App\Repository\GafasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gafas')]
final class GafasController extends AbstractController
{
    #[Route(name: 'app_gafas_index', methods: ['GET'])]
    public function index(GafasRepository $gafasRepository): Response
    {
        return $this->render('gafas/index.html.twig', [
            'gafas' => $gafasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gafas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gafa = new Gafas();
        $form = $this->createForm(GafasType::class, $gafa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gafa);
            $entityManager->flush();

            return $this->redirectToRoute('app_gafas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gafas/new.html.twig', [
            'gafa' => $gafa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gafas_show', methods: ['GET'])]
    public function show(Gafas $gafa): Response
    {
        return $this->render('gafas/show.html.twig', [
            'gafa' => $gafa,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gafas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gafas $gafa, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GafasType::class, $gafa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gafas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gafas/edit.html.twig', [
            'gafa' => $gafa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gafas_delete', methods: ['POST'])]
    public function delete(Request $request, Gafas $gafa, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gafa->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($gafa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gafas_index', [], Response::HTTP_SEE_OTHER);
    }
}
