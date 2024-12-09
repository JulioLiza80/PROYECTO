<?php

namespace App\Controller;

use App\Entity\Lentillas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lentillas')] // Ruta base para las vistas de lentillas
class LentillasController extends AbstractController
{
    #[Route('/', name: 'app_lentillas_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtener todas las lentillas
        $lentillas = $entityManager->getRepository(Lentillas::class)->findAll();

        // Extraer las marcas únicas
        $marcas = array_unique(array_map(function ($lentilla) {
            return $lentilla->getMarca();
        }, $lentillas));

        // Extraer materiales únicos
        $materiales = array_unique(array_map(function ($lentilla) {
            return $lentilla->getMaterial();
        }, $lentillas));

        // Extraer frecuencias únicas
        $frecuencias = array_unique(array_map(function ($lentilla) {
            return $lentilla->getFrecuencia();
        }, $lentillas));

        // Extraer tipos de producto únicos
        $tipo_producto = array_unique(array_map(function ($lentilla) {
            return $lentilla->getTipoProducto(); // Correcto
        }, $lentillas));

        // Extraer tipos únicos de lentillas
        $tipos = array_unique(array_map(function ($lentilla) {
            return $lentilla->getTipo(); // Correcto
        }, $lentillas));


        return $this->render('lentillas.html.twig', [
            'lentillas' => $lentillas,
            'marcas' => $marcas, // Pasar las marcas únicas
            'materiales' => $materiales, // Pasar los materiales únicos
            'frecuencias' => $frecuencias, // Pasar las frecuencias únicas
            'tipo_producto' => $tipo_producto, // Pasar los tipos de producto
            'tipos' => $tipos, // Pasar los tipos de lentillas
        ]);
    }

    #[Route('/{id}/show', name: 'app_lentillas_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Obtener una lentilla específica por su ID
        $lentilla = $entityManager->getRepository(Lentillas::class)->find($id);

        if (!$lentilla) {
            throw $this->createNotFoundException('La lentilla no existe.');
        }

        // Obtener 6 lentillas aleatorias, excluyendo la actual
        $lentillasSugeridas = $entityManager->createQueryBuilder()
            ->select('l')
            ->from(Lentillas::class, 'l')
            ->where('l.id != :id')
            ->setParameter('id', $id)
            ->setMaxResults(6) // Obtener 6 lentillas aleatorias
            ->getQuery()
            ->getResult();

        // Mezclar aleatoriamente las lentillas sugeridas
        shuffle($lentillasSugeridas);

        return $this->render('showDetallesLentillas.html.twig', [
            'lentilla' => $lentilla,
            'stock' => $lentilla->getStock(),
            'lentillas' => $lentillasSugeridas, // Pasar las lentillas sugeridas
        ]);
    }
}
