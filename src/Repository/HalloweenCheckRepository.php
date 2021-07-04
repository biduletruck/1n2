<?php

namespace App\Repository;

use App\Entity\HalloweenCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HalloweenCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method HalloweenCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method HalloweenCheck[]    findAll()
 * @method HalloweenCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HalloweenCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HalloweenCheck::class);
    }

    // /**
    //  * @return HalloweenCheck[] Returns an array of HalloweenCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HalloweenCheck
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
