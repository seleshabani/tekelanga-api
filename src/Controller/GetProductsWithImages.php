<?php
namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class GetProductsWithImages
{
    public function __invoke(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Produit::class);
        $produits = $repo->findAll();
        $cmptr = 0;
        foreach ($produits as $produit) {
            $resultats[$cmptr] = ["produit"=>$produit,"image"=>$produit->getImages()];
            $cmptr++;
        }

        return $resultats;
    }
}