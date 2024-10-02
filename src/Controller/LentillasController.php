<?php

namespace App\Controller;

use App\Entity\Lentillas;
use App\Form\LentillasType;
use App\Repository\LentillasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lentillas')]
final class LentillasController extends AbstractController
{
    #[Route(name: 'app_lentillas_index', methods: ['GET'])]
    public function index(LentillasRepository $lentillasRepository): Response
    {
        return $this->render('lentillas/index.html.twig', [
            'lentillas' => $lentillasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lentillas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lentilla = new Lentillas();
        $form = $this->createForm(LentillasType::class, $lentilla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lentilla);
            $entityManager->flush();

            return $this->redirectToRoute('app_lentillas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lentillas/new.html.twig', [
            'lentilla' => $lentilla,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lentillas_show', methods: ['GET'])]
    public function show(Lentillas $lentilla): Response
    {
        return $this->render('lentillas/show.html.twig', [
            'lentilla' => $lentilla,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lentillas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lentillas $lentilla, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LentillasType::class, $lentilla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lentillas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lentillas/edit.html.twig', [
            'lentilla' => $lentilla,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lentillas_delete', methods: ['POST'])]
    public function delete(Request $request, Lentillas $lentilla, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lentilla->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lentilla);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lentillas_index', [], Response::HTTP_SEE_OTHER);
    }
}
