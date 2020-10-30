<?php

namespace App\Repository;

use App\Entity\Addresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Addresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Addresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Addresse[]    findAll()
 * @method Addresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Addresse::class);
    }

    /**
     * @return Addresse[] Returns an array of Addresse objects
     */
    public function findByAll($v,$comne,$qrtr,$avn,$nmr)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.ville = :v')
            ->andWhere('a.commune = :c')
            ->andWhere('a.quartier = :q')
            ->andWhere('a.avenue = :avn')
            ->andWhere('a.numero = :nmr')
            ->setParameter('v', $v)
            ->setParameter('c', $comne)
            ->setParameter('q', $qrtr)
            ->setParameter('avn', $avn)
            ->setParameter('nmr', $nmr)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // public function findOneByAll(): ?Addresse
    // {
    //     return $this->createQueryBuilder('a')
            
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
