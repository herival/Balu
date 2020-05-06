<?php

namespace App\Repository;

use App\Entity\Packingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Packingredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Packingredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Packingredients[]    findAll()
 * @method Packingredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackingredientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Packingredients::class);
    }

    // /**
    //  * @return Packingredients[] Returns an array of Packingredients objects
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
    public function findOneBySomeField($value): ?Packingredients
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
