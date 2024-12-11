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
            return $gafa->getMarca();
        }, $gafas));

        // Extraer materiales únicos
        $materiales = array_unique(array_map(function ($gafa) {
            return $gafa->getMaterialMontura();
        }, $gafas));

        // Extraer tipos de montura únicos
        $tiposMontura = array_unique(array_map(function ($gafa) {
            return $gafa->getTipoMontura();
        }, $gafas));

        return $this->render('gafas.html.twig', [
            'gafas' => $gafas,
            'marcas' => $marcas,
            'materiales' => $materiales,
            'tiposMontura' => $tiposMontura, 
        ]);
    }

    #[Route('/{id}/show', name: 'app_gafas_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Obtener una gafa solar específica por su ID
        $gafa = $entityManager->getRepository(Gafas::class)->find($id);

        if (!$gafa) {
            throw $this->createNotFoundException('La gafa solar no existe.');
        }

        // Obtener 3 gafas cuyo tipo sea "gafas graduadas", excluyendo la gafa actual
        $gafasGraduadas = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Gafas::class, 'g')
            ->where('g.tipo = :tipoGraduadas')
            ->andWhere('g.id != :id')
            ->setParameter('tipoGraduadas', 'gafas graduadas')
            ->setParameter('id', $id)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        // Obtener 3 gafas cuyo tipo sea "gafas sol", excluyendo la gafa actual
        $gafasSol = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Gafas::class, 'g')
            ->where('g.tipo = :tipoSol')
            ->andWhere('g.id != :id')
            ->setParameter('tipoSol', 'gafas sol')
            ->setParameter('id', $id)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        // Combinar ambas listas
        $gafasSugeridas = array_merge($gafasGraduadas, $gafasSol);

        // Mezclar aleatoriamente las gafas sugeridas
        shuffle($gafasSugeridas);

        return $this->render('showDetallesGafas.html.twig', [
            'gafa' => $gafa,
            'stock' => $gafa->getStock(),
            'gafas' => $gafasSugeridas, // Pasar las gafas combinadas y aleatorias a la vista
        ]);
    }
}