<?php
namespace App\Controller;

use App\Entity\ItemPanier;
use Doctrine\ORM\EntityManagerInterface;

class TopProducts
{
    public function __invoke(EntityManagerInterface $em) {
        $repo = $em->getRepository(ItemPanier::class);
        $top = $repo->findByTop();
        return $top;
    }
}