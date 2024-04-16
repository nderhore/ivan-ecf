<?php

namespace App\Repository;

use App\Entity\Opinions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Opinions>
 *
 * @method Opinions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opinions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opinions[]    findAll()
 * @method Opinions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpinionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opinions::class);
    }

    public function getAverageGrade(): float
    {
        return $this->createQueryBuilder('a')
            ->select('AVG(a.grade) as average')
            ->andWhere('a.is_validated = true')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getValidatedOpinions(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.is_validated = true')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
//    /**
//     * @return Opinions[] Returns an array of Opinions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Opinions
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
