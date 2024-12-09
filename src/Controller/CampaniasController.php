<?php

namespace App\Controller;

use App\Entity\Campanias;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/campanias')]
class CampaniasController extends AbstractController
{
    #[Route('/', name: 'app_campanias_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtener todas las campañas
        $campanias = $entityManager->getRepository(Campanias::class)->findAll();

        // Extraer descripciones únicas
        $descripciones = array_unique(array_map(function ($campania) {
            return $campania->getImageDescription();
        }, $campanias));

        // Filtrar campañas activas (estado = true)
        $campaniasActivas = array_filter($campanias, function ($campania) {
            return $campania->isEstado();
        });

        return $this->render('campanias.html.twig', [
            'campanias' => $campanias,
            'descripciones' => $descripciones,
            'campanias_activas' => $campaniasActivas,
        ]);
    }
}
