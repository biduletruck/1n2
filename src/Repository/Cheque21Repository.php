<?php

namespace App\Repository;

use App\Entity\Cheque21;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cheque21|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cheque21|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cheque21[]    findAll()
 * @method Cheque21[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Cheque21Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cheque21::class);
    }

    // /**
    //  * @return Cheque21[] Returns an array of Cheque21 objects
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
    public function findOneBySomeField($value): ?Cheque21
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
