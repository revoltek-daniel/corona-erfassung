<?php

namespace App\Repository;

use App\Entity\ContactPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method ContactPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactPerson[]    findAll()
 * @method ContactPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactPersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactPerson::class);
    }

    public function findExisting(ContactPerson $contactPerson)
    {
        $qb = $this->createQueryBuilder('c');

        $query = $qb
            ->andWhere(
                $qb->expr()->andX(
                    $qb->expr()->andX(
                        $qb->expr()->eq('c.firstname', ':firstname'),
                        $qb->expr()->eq('c.lastname', ':lastname'),
                        $qb->expr()->eq('c.zip', ':zip'),
                        $qb->expr()->eq('c.city', ':city')
                    ),
                    $qb->expr()->orX(
                        $qb->expr()->andX(
                            $qb->expr()->eq('c.phone', ':phone')
                        ),
                        $qb->expr()->andX(
                            $qb->expr()->eq('c.email', ':email')
                        )
                    )
                )
            )
            ->setParameter('phone', $contactPerson->getPhone())
            ->setParameter('firstname', $contactPerson->getFirstname())
            ->setParameter('lastname', $contactPerson->getLastname())
            ->setParameter('email', $contactPerson->getEmail())
            ->setParameter('zip', $contactPerson->getZip())
            ->setParameter('city', $contactPerson->getCity())
        ;

        return $query->getQuery()
            ->getOneOrNullResult();
    }


    // /**
    //  * @return ContactPerson[] Returns an array of ContactPerson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactPerson
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
