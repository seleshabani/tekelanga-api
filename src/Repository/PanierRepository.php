<?php

namespace App\Repository;

use App\Entity\Panier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    /**
     * @return Panier[] Returns an array of Panier objects
     */
    
    public function findByValide($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.valide = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findBySecret($secret,$tel)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM App\Entity\Panier p JOIN App\Entity\Client c WHERE p.secret = :s And c.telephone = :t");
        $query->setParameters([":s"=>$secret,":t"=>$tel]);
        $query->setMaxResults(1);
        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Panier
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
