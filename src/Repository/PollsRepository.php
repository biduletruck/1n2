<?php

namespace App\Repository;

use App\Entity\Polls;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Polls|null find($id, $lockMode = null, $lockVersion = null)
 * @method Polls|null findOneBy(array $criteria, array $orderBy = null)
 * @method Polls[]    findAll()
 * @method Polls[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Polls::class);
    }

    // /**
    //  * @return Polls[] Returns an array of Polls objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Polls
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
