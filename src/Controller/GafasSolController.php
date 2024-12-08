<?php

namespace App\Controller;

use App\Entity\Gafas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gafas-sol')] // Ruta base para las vistas de gafas solares
class GafasSolController extends AbstractController
{
    #[Route('/', name: 'app_gafas_sol_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtener todas las gafas solares
        $gafas = $entityManager->getRepository(Gafas::class)->findAll();

        // Extraer las marcas únicas
        $marcas = array_unique(array_map(function ($gafa) {
            return $gafa->getMarca();  // Asegúrate de que el método getMarca() exista en tu entidad
        }, $gafas));

        // Extraer materiales únicos
        $materiales = array_unique(array_map(function ($gafa) {
            return $gafa->getMaterialMontura();
        }, $gafas));

        // Extraer tipos de montura únicos
        $tiposMontura = array_unique(array_map(function ($gafa) {
            return $gafa->getTipoMontura();
        }, $gafas));

        return $this->render('gafas_sol.html.twig', [
            'gafas' => $gafas,
            'marcas' => $marcas,  // Pasar las marcas únicas
            'materiales' => $materiales,  // Pasar los materiales únicos
            'tiposMontura' => $tiposMontura,  // Pasar los tipos de montura únicos
        ]);
    }

    #[Route('/{id}/show', name: 'app_gafas_sol_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Obtener una gafa solar específica por su ID
        $gafa = $entityManager->getRepository(Gafas::class)->find($id);

        if (!$gafa) {
            throw $this->createNotFoundException('La gafa solar no existe.');
        }

        // Obtener hasta 6 gafas aleatorias excluyendo la actual
        $gafasRandom = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Gafas::class, 'g')
            ->where('g.id != :id')
            ->setParameter('id', $id)
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();

        return $this->render('showDetallesGafas.html.twig', [
            'gafa' => $gafa,
            'gafas' => $gafasRandom, // Pasar las gafas a la vista como `gafas`
        ]);
    }
}
