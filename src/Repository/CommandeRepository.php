<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    
    /**
     * @return Commande[] Returns an array of Commande objects
     */
    
    public function findDerniereCommande()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.date', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }
    // SELECT SUM(nom_colonne)FROM table
        
    
    /**
     * @return Commande[] Returns an array of Commande objects
     */
    
    public function chiffreAffaire()
    {
        return $this->createQueryBuilder('c')
            ->select('SUM(c.montant)')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * @return Commande[] Returns an array of Commande objects
     */
    
    public function findByMembre($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.membre = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    
    public function findByEtat($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.etat = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commande
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
