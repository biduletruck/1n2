<?php

namespace App\Repository;

use App\Entity\Colis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Colis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colis[]    findAll()
 * @method Colis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colis::class);
    }

    // /**
    //  * @return Colis[] Returns an array of Colis objects
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
    public function findOneBySomeField($value): ?Colis
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
