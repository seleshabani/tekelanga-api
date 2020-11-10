<?php
namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;

class validateBaskets
{
    public function __invoke(EntityManagerInterface $em){
        $repo = $em->getRepository(Panier::class);
        $resultats = $repo->findByValide(true);
        return $resultats;
    }
}