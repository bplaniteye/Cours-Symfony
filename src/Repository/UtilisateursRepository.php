<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateurs[]    findAll()
 * @method Utilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateurs::class);
    }

    public function findByHomme()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
       // ->from('Utilisateurs' , 'u')
        ->where('u.sexe =:sexe')
        ->setParameter('sexe' , 'Homme')
        ->orderBy('u.prenom', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function findByArchive()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
       // ->from('Utilisateurs' , 'u')
        ->where('u.statut =:statut')
        ->setParameter('statut' , 'Archivé')
        ->orderBy('u.prenom', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function findByPublie()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
       // ->from('Utilisateurs' , 'u')
        ->where('u.statut =:statut')
        ->setParameter('statut' , 'Publié')
        ->orderBy('u.prenom', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function findByHommePublie()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
       // ->from('Utilisateurs' , 'u')
        ->where('u.statut =:statut')
        ->setParameter('statut' , 'Publié')
        ->andwhere('u.sexe=:sexe')
        ->setParameter('sexe','Homme')
        ->orderBy('u.prenom', 'ASC');
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Utilisateurs[] Returns an array of Utilisateurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Utilisateurs
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
