<?php

namespace App\Repository;

use App\Entity\PackIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PackIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackIngredient[]    findAll()
 * @method PackIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackIngredient::class);
    }

    /**
     * @return PackIngredient[] Returns an array of PackIngredient objects
     */
    
    public function findByRecette($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.recette = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return PackIngredient[] Returns an array of PackIngredient objects
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
    /*
    public function findOneBySomeField($value): ?PackIngredient
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
