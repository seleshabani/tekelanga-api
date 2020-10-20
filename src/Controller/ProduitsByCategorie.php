<?php
namespace App\Controller;

use App\Entity\Categories;

class ProduitsByCategorie
{
    public function __invoke(Categories $data){
        return $data->getProduits();
    }
}