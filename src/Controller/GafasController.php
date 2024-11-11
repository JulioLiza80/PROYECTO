<?php

namespace App\Controller;

use App\Entity\Gafas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gafas')] // Ruta base para las vistas de gafas
class GafasController extends AbstractController
{
    #[Route('/', name: 'app_gafas_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtener todas las gafas desde la base de datos
        $gafas = $entityManager->getRepository(Gafas::class)->findAll();
        
        return $this->render('gafas.html.twig', [
            'gafas' => $gafas,
        ]);
    }

    #[Route('/{id}/show', name: 'app_gafas_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Obtener una gafa específica por su ID
        $gafa = $entityManager->getRepository(Gafas::class)->find($id);

        if (!$gafa) {
            throw $this->createNotFoundException('La gafa no existe.');
        }

        return $this->render('gafas/show.html.twig', [
            'gafa' => $gafa,
        ]);
    }
}
