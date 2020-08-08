<?php

namespace App\Repository;

use App\Entity\Victories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Victories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Victories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Victories[]    findAll()
 * @method Victories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VictoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Victories::class);
    }

    // /**
    //  * @return Victories[] Returns an array of Victories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Victories
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
