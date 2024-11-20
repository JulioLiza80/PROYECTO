<?php

namespace App\Repository;

use App\Entity\Gafas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gafas>
 */
class GafasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gafas::class);
    }

    // Método para encontrar todas las gafas
    public function findAllGafas(): array
    {
        return $this->findAll();
    }

    // Método para actualizar el stock
    public function actualizarStock($cantidad, Gafas $gafas): void
    {
        $c = $gafas->getStock() - $cantidad;
        $gafas->setStock($c);
        $this->getEntityManager()->persist($gafas);
        $this->getEntityManager()->flush();
    }
}
