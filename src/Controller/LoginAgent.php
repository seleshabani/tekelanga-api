<?php
namespace App\Controller;

use App\Entity\Agent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginAgent
{
    public function __invoke(EntityManagerInterface $em,Request $request)
    {
        $repo = $em->getRepository(Agent::class);
        $agent = $repo->findOneByMail($request->get('mail'));

        if ($agent) {
            if (password_verify($request->get('password'),$agent->getPassword())) {
                return $agent;
            }else{
                return '0';
            }
        }else{
            return '0';
        }
    }
}