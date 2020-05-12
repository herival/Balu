<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    /**
     * @return Commentaire[] Returns an array of Commentaire objects
     */
    
    public function findByMembre($membre, $recette)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.membre = :membre')
            ->andWhere('c.recette = :recette')
            ->setParameter('membre', $membre)
            ->setParameter('recette', $recette)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByNote_positif($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.note >= :note')
            ->setParameter('note', $value)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByNote_negatif($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.note < :note')
            ->setParameter('note', $value)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    // /**
    //  * @return Commentaire[] Returns an array of Commentaire objects
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
    public function findOneBySomeField($value): ?Commentaire
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
