<?php

namespace App\Repository;

use App\Entity\Lentillas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lentillas>
 */
class LentillasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lentillas::class);
    }

    //    /**
    //     * @return Lentillas[] Returns an array of Lentillas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
   

       public function findOneById($value): ?Lentillas
        {
            return $this->createQueryBuilder('l')
                ->andWhere('l.id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

        //Actualizar stock
        public function actualizarStock($cantidad, Lentillas $lentillas):void
      {
         $c=$lentillas->getStock()-$cantidad;
          $lentillas->setStock($c);
          $this->getEntityManager()->persist($lentillas);
          $this->getEntityManager()->flush();
        
        
       }
}
