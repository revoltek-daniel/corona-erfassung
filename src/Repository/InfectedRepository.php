<?php

namespace App\Repository;

use App\Entity\InfectedPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method InfectedPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfectedPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfectedPerson[]    findAll()
 * @method InfectedPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfectedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfectedPerson::class);
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
    public function countInfected(): int
    {
        $qb = $this->createQueryBuilder('i');

        return $qb
            ->select('count(i.id)')
            ->where($qb->expr()->eq('i.positiveTest', 1))
            ->getQuery()
            ->useQueryCache(true)
            ->enableResultCache(true, 3600)
            ->getSingleScalarResult();
    }

    public function countInfectedForCurrentWeek(): int
    {
        $qb = $this->createQueryBuilder('i');

        return $qb
            ->select('count(i.id)')
            ->where($qb->expr()->eq('i.positiveTest', 1))
            ->andWhere($qb->expr()->gte('i.quarantineStart', ':thisMonday'))
            ->setParameter('thisMonday', new \DateTime('this monday'),  \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)
            ->getQuery()
            ->useQueryCache(true)
            ->enableResultCache(true, 3600)
            ->getSingleScalarResult();
    }
}
