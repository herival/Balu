<?php

namespace App\Repository;

use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Membre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membre[]    findAll()
 * @method Membre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membre::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Membre) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @return Membre[] Returns an array of Membre objects
     */
    
    public function findByRoles($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.roles = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Membre[] Returns an array of Recette objects
     */
    
    public function findByNom($recherche)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.nom LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%")
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * @return Membre[] Returns an array of Recette objects
     */
    
    public function findByPrenom($recherche)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.prenom LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%")
            ->orderBy('m.prenom', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Membre[] Returns an array of Membre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Membre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
         /**
     * @return Record[] Returns an array of Record objects
     */
    public function findRecord()
    {
        // SELECT a.* FROM artist WHERE name = "% . $recherche . %"
        return $this->createQueryBuilder('r')
            ->orderBy('r.releasedAt', 'DESC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult()
        ;
    }
}
