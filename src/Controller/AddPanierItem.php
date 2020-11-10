<?php
namespace App\Controller;

use App\Entity\Stock;
use App\Entity\ItemPanier;
use Doctrine\ORM\EntityManagerInterface;

class AddPanierItem
{
    public function __invoke(ItemPanier $data,EntityManagerInterface $em){

        // dd($data);
        // $em->persist($data);
        // $em->flush();
        // $stockRepo = $em->getRepository(Stock::class);
        // $stock = $stockRepo->findOneByIdProduit($data->getIdProduit());
        // $qteRest = $stock->getStockRest();
        // $stockRest = $qteRest - $data->getQuantite();
        // $totalStockRestInit = $stock->getTotalStockRest();
        // $totalStockRest = $totalStockRestInit - ($data->getQuantite() * $stock->getPrixUnitaire());
        // $stock->setStockRest($stockRest);
        // $stock->setTotalStockRest($totalStockRest);
        // $em->persist($stock);
        $em->persist($data);
        $em->flush();
    }
}