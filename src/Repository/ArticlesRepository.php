<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByPublies()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
       // ->from('Utilisateurs' , 'u')
        ->where('a.statut =:statut')
        ->setParameter('statut' , 'Publié')
        ->orderBy('a.id', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function findByNonPublies()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
       // ->from('Utilisateurs' , 'u')
        ->where('a.statut =:statut')
        ->setParameter('statut' , 'Non Publié')
        ->orderBy('a.id', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function findByArchives()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
       // ->from('Utilisateurs' , 'u')
        ->where('a.statut =:statut')
        ->setParameter('statut' , 'Archivé')
        ->orderBy('a.id', 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function categorie() 
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('App\Entity\Categorie', 'c' , 'WITH' , ' c = a.categorie')
        ->orderBy('a.titre' , 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function articlesBD() 
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('App\Entity\Categorie', 'c' , 'WITH' , ' c = a.categorie')
        ->where('c.titre like :titre')
        ->setParameter('titre' , 'BD')
        ->orderBy('a.titre' , 'ASC');
        return $qb->getQuery()->getResult();
    }

    public function auteursPublies() 
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('App\Entity\Auteurs', 'o' , 'WITH' , ' o = a.auteurs')
        ->Where('o.prenom like :prenom')
        ->setParameter('prenom' , 'Arthur')
        ->andwhere('a.statut like :statut')
        ->setParameter('statut' , 'Publié')      
        ->orderBy('a.id' , 'ASC');
        return $qb->getQuery()->getResult();
    }



}
