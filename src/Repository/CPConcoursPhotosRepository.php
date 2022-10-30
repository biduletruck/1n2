<?php

namespace App\Repository;

use App\Entity\CPConcoursPhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CPConcoursPhotos>
 *
 * @method CPConcoursPhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CPConcoursPhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CPConcoursPhotos[]    findAll()
 * @method CPConcoursPhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CPConcoursPhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CPConcoursPhotos::class);
    }

    public function add(CPConcoursPhotos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CPConcoursPhotos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CPConcoursPhotos[] Returns an array of CPConcoursPhotos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CPConcoursPhotos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
