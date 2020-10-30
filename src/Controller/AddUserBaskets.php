<?php
namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class AddUserBaskets {

    public function __invoke(Panier $data, EntityManager $em, Request $r) {

        
    }
}