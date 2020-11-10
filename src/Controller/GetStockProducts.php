<?php
namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;

class GetStockProducts
{
    public function __invoke(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Stock::class);

        $resultat = $repo->findAll();
        $cmptr = 0;
        foreach ($resultat as $r) {
            $produit[$cmptr] = ["stock"=>$r,"produit"=>$r->getIdProduit(),"images"=>$r->getIdProduit()->getImages()];
            $cmptr++;
        }
        return $produit;
    }
}