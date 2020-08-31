<?php

namespace App\Repository;

use App\Entity\BbqEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BbqEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BbqEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BbqEvent[]    findAll()
 * @method BbqEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BbqEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BbqEvent::class);
    }

    // /**
    //  * @return BbqEvent[] Returns an array of BbqEvent objects
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
    public function findOneBySomeField($value): ?BbqEvent
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
