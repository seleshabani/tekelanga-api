<?php
namespace App\DataPersister;

use App\Entity\Panier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class PanierPersister implements DataPersisterInterface 
{
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
       // $this->request = $request;
    }
     /**
     * Is the data supported by the persister?
     */
    public function supports($data): bool {
        return $data instanceof Panier;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data){
        
       // dd($data);
    }

    /**
     * Removes the data.
     */
    public function remove($data) { 

    }
}