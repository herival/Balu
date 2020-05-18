<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    /**
     * @return Recette[] Returns an array of Recette objects
     */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Recette[] Returns an array of Recette objects
     */
    
    public function findByTitre($recherche)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.titre LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%")
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return Recette[] Returns an array of Recette objects
     */

    public function findByCategorie($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.categorie = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Recette[] Returns an array of Recette objects
     */

    public function findByCategorieLimit($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.categorie = :val')
            ->setParameter('val', $value)
            ->setMaxResults(3)
            ->orderBy('RAND()')
            ->getQuery()
            ->getResult()
        ;
    }

    public function PaysFindBySousCategorie($categorie, $souscategorie)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->andWhere('r.souscategorie = :souscategorie')
            ->setParameter('souscategorie', $souscategorie)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByIngredient($recherche)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.preparation LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%")
            ->orderBy('r.titre', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Recette[] Returns an array of Recette objects
     */

    public function findBySousCategorie($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.souscategorie = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Recette[] Returns an array of Recette objects
     */

    public function findByMembre($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.membre = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
    

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
