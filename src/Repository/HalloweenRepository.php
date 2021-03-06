<?php

namespace App\Repository;

use App\Entity\Halloween;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Halloween|null find($id, $lockMode = null, $lockVersion = null)
 * @method Halloween|null findOneBy(array $criteria, array $orderBy = null)
 * @method Halloween[]    findAll()
 * @method Halloween[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HalloweenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Halloween::class);
    }

    // /**
    //  * @return Halloween[] Returns an array of Halloween objects
    //  */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->select('h.User')
            ->andWhere('h.User = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Halloween
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
