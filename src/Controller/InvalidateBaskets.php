<?php
namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;

class InvalidateBaskets
{
    public function __invoke(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Panier::class);
        $results = $repo->findByValide(false);
        return $results;
    }
}   