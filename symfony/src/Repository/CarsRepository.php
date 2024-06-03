<?php

namespace App\Repository;

use App\Entity\Cars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cars>
 *
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }

    public function findByCriteria($km,$year,$price){

        //construction de la requete
        $queryBuilder = $this->createQueryBuilder('c');

        //implementation des criteres de recherche
        if ($km) {
            $qb->andWhere('c.kilometer <= :km')
               ->setParameter('km', $km);
        }

        if ($year) {
            $qb->andWhere('c.build_year >= :year')
               ->setParameter('year', $year);
        }

        if ($price) {
            $qb->andWhere('c.price <= :price')
               ->setParameter('price', $price);
        }

        return $queryBuilder->getQuery()->getResult();
    }

}
