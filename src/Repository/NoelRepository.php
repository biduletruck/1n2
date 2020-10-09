<?php

namespace App\Repository;

use App\Entity\Noel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Noel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noel[]    findAll()
 * @method Noel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noel::class);
    }

    // /**
    //  * @return Noel[] Returns an array of Noel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Noel
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
