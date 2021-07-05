<?php

namespace App\Repository;

use App\Entity\Participations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participations[]    findAll()
 * @method Participations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participations::class);
    }

    /**
    * @return Participations[] Returns an array of Participations objects
    */

    public function findAllWithOrder()
    {
        return $this->createQueryBuilder('p')
            ->select('p', '(TIMETOSEC(TIMEDIFF(p.dateValidation, p.createdAt))) as delta')

            ->addOrderBy('p.score', 'DESC')
            ->addOrderBy('p.delta', ' ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Participations
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
