<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questions::class);
    }

    // /**
    //  * @return Questions[] Returns an array of Questions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function countCategorysInQuestion($quiz)
    {
        return $this->createQueryBuilder('q')
            ->select('COUNT(DISTINCT q.Difficulty) as nbCat')
            ->andWhere('q.Poll = :quiz')
            ->setParameter('quiz', $quiz)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function QuestionsInCategory($category)
    {
        return $this->createQueryBuilder('q')
            ->select('DISTINCT q.id as Questions')
            ->andWhere('q.Difficulty = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCategorysInQuestion($quiz)
    {
        return $this->createQueryBuilder('q')
            ->select('DISTINCT q.Difficulty as category')
            ->andWhere('q.Poll = :quiz')
            ->setParameter('quiz', $quiz)
            ->getQuery()
            ->getArrayResult()
            ;
    }

}
