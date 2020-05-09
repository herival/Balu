<?php

namespace App\Repository;

use App\Entity\Detailcommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailcommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailcommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailcommande[]    findAll()
 * @method Detailcommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailcommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailcommande::class);
    }


    /**
     * @return Detailcommande[] Returns an array of Detailcommande objects
     */
    
    public function findByCommande($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.commande = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    


    // /**
    //  * @return Detailcommande[] Returns an array of Detailcommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detailcommande
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
