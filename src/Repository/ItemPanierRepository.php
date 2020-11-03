<?php

namespace App\Repository;

use App\Entity\ItemPanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemPanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemPanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemPanier[]    findAll()
 * @method ItemPanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemPanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemPanier::class);
    }

     /**
     * @return ItemPanier[] Returns an array of ItemPanier objects
     */
    public function findByTop() : array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT count(i.idProduit) as nbr,p FROM App\Entity\itemPanier i JOIN App\Entity\Produit p WHERE i.idProduit = p GROUP BY i.idProduit");
        $query->setMaxResults(3);
        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?ItemPanier
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
