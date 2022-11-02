<?php

namespace App\Repository;

use App\Entity\CPClassement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CPClassement>
 *
 * @method CPClassement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CPClassement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CPClassement[]    findAll()
 * @method CPClassement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CPClassementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CPClassement::class);
    }

    public function add(CPClassement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CPClassement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CPClassement[] Returns an array of CPClassement objects
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

    public function findAllResults($concours): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin("c.Image", "i")
            ->Select("i.NonParticipant, sum(c.NombrePoints) as TotalPoint, i.id")
            ->andWhere('c.ConcoursPhotos = :concours')
//            ->from('c', 'rzpp')
            ->setParameter('concours', $concours)
            ->groupBy("i.NonParticipant, i.id")
            ->orderBy("TotalPoint", "DESC")
            ->getQuery()
            ->getResult()
        ;
    }

//$query = $em->createQueryBuilder('r')
//->select('rzpp')
//->where('rzpp.id = :id')
//->from('totoFrontBundle:User', 'rzpp')
//->leftJoin("rzpp.country", "p")
//->setParameter('id', '1')
//->getQuery();

//    public function findAllResults($concours): ?CPClassement
//    {
//        $query = $this->getEntityManager()->createQuery("select c.Image as participant, sum(c.NombrePoints) as TotalPoint FROM c");
////        $query->setParameter('id', $concours);
//        return $query->getResult();

//    }
//$query = $em->createQuery('SELECT c AS financement, SUM(p.participation) AS participation FROM Financement c JOIN c.participants p WHERE p.utilisateur = :id GROUP BY c.id');
//$query->setParameter('id', $id);
//
//return $query->getResult();
//$q = Doctrine_Query::create()
//->select('p.id, p.idparticipant, p.idevenement, p.montantparticipation, SUM(pa.montant) as somme')
//->from('Participation p')
//->leftJoin('p.Paiement pa ON p.id = pa.idparticipation')
//->groupby('p.id');
}
