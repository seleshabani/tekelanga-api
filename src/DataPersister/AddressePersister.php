<?php
namespace App\DataPersister;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Addresse;
use App\Repository\AddresseRepository;

class AddressePersister implements DataPersisterInterface 
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
        return $data instanceof Addresse;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data){
        
        $addRepo = $this->em->getRepository(Addresse::class);
        $result = $addRepo->findByAll($data->getVille(),$data->getCommune(),$data->getQuartier(),$data->getAvenue(),$data->getNumero());
        if ($result != null) {
            return $result[0];
        }else{
            $this->em->persist($data);
            $this->em->flush();
        }
       // dd($data);
    }

    /**
     * Removes the data.
     */
    public function remove($data) { 

    }
}