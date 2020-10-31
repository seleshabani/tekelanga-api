<?php
namespace App\DataPersister;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Client;

class ClientPersister implements DataPersisterInterface 
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
        return $data instanceof Client;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data){
        
       $repo = $this->em->getRepository(Client::class);
       $result = $repo->findOneByTelephone($data->getTelephone());

       if ($result != null) {
          return $result;
       }else{
           //$data->setIdAddress($data->getIdAddress());
           $this->em->persist($data);
           $this->em->flush();
       }
    }

    /**
     * Removes the data.
     */
    public function remove($data) { 

    }
}