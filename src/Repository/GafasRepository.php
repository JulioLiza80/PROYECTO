<?php

namespace App\Repository;

use App\Entity\Gafas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;

use function PHPSTORM_META\elementType;

/**
 * @extends ServiceEntityRepository<Gafas>
 */
class GafasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gafas::class);
    }

    //    *
    //     * @return Gafas[] Returns an array of Gafas objects
    //     
      /*  public function findById($value): Gafas
       {
            return $this->createQueryBuilder('g')
                ->andWhere('g.id = :val')
                ->setParameter('val', $value)
                ->orderBy('g.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
       }*/

       //actualizar stock
       public function actualizarStock($cantidad, Gafas $gafas):void
      {
         $c=$gafas->getStock()-$cantidad;
          $gafas->setStock($c);
          $this->getEntityManager()->persist($gafas);
          $this->getEntityManager()->flush();
        
        
       }
      
      public function findOneById($value): ?Gafas
       {
           return $this->createQueryBuilder('g')
               ->andWhere('g.id= :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
}
