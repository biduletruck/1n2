<?php

namespace App\Repository;

use App\Entity\Matches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matches[]    findAll()
 * @method Matches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matches::class);
    }

    public function findByDay(\DateTime $date)
    {

        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");

        $qb = $this->createQueryBuilder("m");
        $qb
            ->andWhere('m.StartTime BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
        ;
        return $qb->getQuery()->getResult();

    }

    public function isValidHour(\DateTime $date)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.StartTime < :val')
            ->setParameter('val', $date)
            ->getQuery()
            ->getResult();
    }

    public function findResultMatch($id)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->andHaving('m.Victory is not null')
            ->setParameter('val', $id)
            ->getQuery()
            ->getSingleResult();
    }

    public function findAllResultMatch()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.Victory is not null')
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Matches[] Returns an array of Matches objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matches
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
