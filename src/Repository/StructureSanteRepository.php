<?php

namespace App\Repository;

use App\Entity\StructureSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StructureSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method StructureSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method StructureSante[]    findAll()
 * @method StructureSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StructureSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StructureSante::class);
    }

    // /**
    //  * @return StructureSante[] Returns an array of StructureSante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StructureSante
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
