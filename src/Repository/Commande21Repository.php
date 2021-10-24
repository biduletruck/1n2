<?php

namespace App\Repository;

use App\Entity\Commande21;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande21|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande21|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande21[]    findAll()
 * @method Commande21[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Commande21Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande21::class);
    }

    // /**
    //  * @return Commande21[] Returns an array of Commande21 objects
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
    public function findOneBySomeField($value): ?Commande21
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countCommandes()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c) as nbCommandes')
            ->getQuery()
            ->getSingleResult()
            ;
    }

    public function countCommandesByType()
    {
        return $this->createQueryBuilder('c')
            ->join('c.package', 'p')
            ->select('count(c.package) as nbCommandes, p.titlePackage as titre')
            ->addGroupBy('titre')
            ->getQuery()
            ->getArrayResult()
            ;
    }

    public function countCommandesByCheque()
    {
        return $this->createQueryBuilder('c')
            ->join('c.cheque', 'p')
            ->select('count(c.cheque) as nbCheque, p.titleCheque as titre')
            ->addGroupBy('titre')
            ->getQuery()
            ->getArrayResult()
            ;
    }
}
