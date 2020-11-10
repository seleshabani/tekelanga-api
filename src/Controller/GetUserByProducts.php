<?php
namespace App\Controller;

use App\Entity\ItemPanier;
use Doctrine\ORM\EntityManagerInterface;

class GetUserByProducts
{
    public function __invoke(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(ItemPanier::class);
        $items = $repo->findAll();
        $cmptr = 0;
        foreach ($items as $item) {
            $results[$cmptr] = ["produit"=>$item->getIdProduit(),"client"=>$item->getIdPanier()->getIdClient()];
            $cmptr++;
        }
        return $results;
    }   
}