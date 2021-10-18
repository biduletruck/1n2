<?php

namespace App\Repository;

use App\Entity\Package21;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Package21|null find($id, $lockMode = null, $lockVersion = null)
 * @method Package21|null findOneBy(array $criteria, array $orderBy = null)
 * @method Package21[]    findAll()
 * @method Package21[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Package21Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Package21::class);
    }

    // /**
    //  * @return Package21[] Returns an array of Package21 objects
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
    public function findOneBySomeField($value): ?Package21
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
