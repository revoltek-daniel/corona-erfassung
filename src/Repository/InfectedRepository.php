<?php

namespace App\Repository;

use App\Entity\Infected;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Infected|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infected|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infected[]    findAll()
 * @method Infected[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfectedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infected::class);
    }

    // /**
    //  * @return Infected[] Returns an array of Infected objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Infected
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
