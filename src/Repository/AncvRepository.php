<?php

namespace App\Repository;

use App\Entity\Ancv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ancv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ancv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ancv[]    findAll()
 * @method Ancv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ancv::class);
    }

    // /**
    //  * @return Ancv[] Returns an array of Ancv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ancv
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
