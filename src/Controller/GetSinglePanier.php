<?php
namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class GetSinglePanier
{
    public function __invoke(EntityManagerInterface $em,Request $request)
    {
        $repo = $em->getRepository(Panier::class);
        $secret = $request->get('secret');
        $tel = $request->get('tel');

        $resultat = $repo->findBySecret($secret,$tel);
        if (count($resultat)<1) {
            return "false";
        }else {
            return $resultat;
        }
    }
}