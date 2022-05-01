<?php

namespace App\Repository;

use App\Entity\Ancv2022;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ancv2022>
 *
 * @method Ancv2022|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ancv2022|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ancv2022[]    findAll()
 * @method Ancv2022[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ancv2022Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ancv2022::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Ancv2022 $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Ancv2022 $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Ancv2022[] Returns an array of Ancv2022 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ancv2022
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
