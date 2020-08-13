<?php

namespace App\Repository;

use App\Entity\Predictions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Predictions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Predictions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Predictions[]    findAll()
 * @method Predictions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PredictionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Predictions::class);
    }

    public function findByDay($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.CreatedAt < :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function findAllByPoints()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.points', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findGameByPoints($game)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.Game = :val')
            ->setParameter('val', $game)
            ->andHaving('p.points > 0')
            ->orderBy('p.points', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findIsProntosic($user, $game)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.User = :userVal')
            ->andWhere('p.Game = :gameVal')
            ->setParameter('userVal', $user)
            ->setParameter('gameVal', $game)
            ->getQuery()
            ->getArrayResult();

    }


    public function findUserAsProntosic($game)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.Game = :gameVal')
            ->setParameter('gameVal', $game)
            ->getQuery()
            ->getResult();
    }

    public function findClassementPoints()
    {
        return $this->createQueryBuilder('p')
            ->select('SUM(p.points) as pts','u.username as user')
            ->leftJoin('p.User', 'u')
            ->groupBy('user')
            ->addOrderBy('pts', 'DESC')
            ->addOrderBy('user', 'ASC')
            ->andHaving('pts > 0')
            ->getQuery()
            ->getScalarResult();
    }



    // /**
    //  * @return Predictions[] Returns an array of Predictions objects
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
    public function findOneBySomeField($value): ?Predictions
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
