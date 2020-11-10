<?php
namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;

class GetTotalVente
{
    public function __invoke(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Panier::class);
        $resultats = $repo->findByValide(false);
        $total = 0;

        foreach ($resultats as $resultat) {
            $total = $resultat->getPrixTotal() + $total;
        }
        return $total;
    }
}