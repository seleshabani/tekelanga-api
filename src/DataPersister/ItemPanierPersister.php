<?php
namespace App\DataPersister;

use App\Entity\Stock;
use App\Entity\ItemPanier;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class ItemPanierPersister implements DataPersisterInterface
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
    public function supports($data):bool{
        return $data instanceof ItemPanier;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data){
        $stockRepo = $this->em->getRepository(Stock::class);
        $stock = $stockRepo->findOneByIdProduit($data->getIdProduit());
        $qteRest = $stock->getStockRest();
        $stockRest = $qteRest - $data->getQuantite();
        $totalStockRestInit = $stock->getTotalStockRest();
        $totalStockRest = $totalStockRestInit - ($data->getQuantite() * $stock->getPrixUnitaire());
        $stock->setStockRest($stockRest);
        $stock->setTotalStockRest($totalStockRest);
        $this->em->persist($stock);
        $this->em->persist($data);
        $this->em->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data){

    }


}