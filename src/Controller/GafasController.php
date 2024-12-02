<?php

namespace App\Controller;

use App\Entity\Gafas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gafas')] // Ruta base para las vistas de gafas
class GafasController extends AbstractController
{
    #[Route('/', name: 'app_gafas_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtener todas las gafas
        $gafas = $entityManager->getRepository(Gafas::class)->findAll();

        // Extraer las marcas únicas
        $marcas = array_unique(array_map(function ($gafa) {
            return $gafa->getMarca();  // Asegúrate de que el método getMarca() exista en tu entidad
        }, $gafas));

        return $this->render('gafas.html.twig', [
            'gafas' => $gafas,
            'marcas' => $marcas,  // Pasar las marcas únicas
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