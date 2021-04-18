<?php

namespace App\Repository;

use App\Entity\Musical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Musical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Musical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Musical[]    findAll()
 * @method Musical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Musical::class);
    }

    // /**
    //  * @return Musical[] Returns an array of Musical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Musical
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
