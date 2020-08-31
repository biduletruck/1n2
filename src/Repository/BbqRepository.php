<?php

namespace App\Repository;

use App\Entity\Bbq;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bbq|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bbq|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bbq[]    findAll()
 * @method Bbq[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BbqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bbq::class);
    }

    // /**
    //  * @return Bbq[] Returns an array of Bbq objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bbq
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
