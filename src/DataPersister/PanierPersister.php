<?php
namespace App\DataPersister;

use App\Entity\Stock;
use App\Entity\Panier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
       // $stockRepo = $this->em->getRepository(Stock::class);
        //$data->setValide(false);
        $client = $data->getidclient();
        $clientNom = $client->getNom();
        $clientTel = $client->getTelephone();
        $clientMail = $client->getMail();
        $nomlen = strlen($clientNom);
        $tellen = strlen($clientTel);
        $maillen = strlen($clientMail);
        if($data->getSecret() == null){
            $secret = substr($clientNom,-$nomlen,3) . substr($clientTel,-$tellen,3) . substr($clientMail,mt_rand(1,3),-$maillen). mt_rand(0,500);
            $data->setSecret(trim($secret));
        }

        //$itemsPanier = $data->getItemPaniers();

        // foreach ($itemsPanier as $item) {

        //     $stock = $stockRepo->findOneByIdProduit($item->getIdProduit());
        //     $qteRest = $stock->getStockRest();
        //     $stockRest = $qteRest - $item->getQuantite();
        //     $totalStockRestInit = $stock->getTotalStockRest();
        //     $totalStockRest = $totalStockRestInit - ($item->getQuantite() * $stock->getPrixUnitaire());
        //     $stock->setStockRest($stockRest);
        //     $stock->setTotalStockRest($totalStockRest);
        //     $this->em->persist($stock);
        // }

        $this->em->persist($data);
        $this->em->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data) { 

    }
}