<?php
namespace App\Controller;

use App\Entity\Images;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateImageObjectAction
{
    public function __invoke(Request $request,EntityManagerInterface $em)
    {
        
        $prodRepo = $em->getRepository(Produit::class);

        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new Images();
        $mediaObject->setLabel($request->request->get('label'));
        $produit = $prodRepo->find($request->request->get('id_produit_id'));
        $mediaObject->setIdProduit($produit);
        $mediaObject->file = $uploadedFile;

        $produit->setImages($mediaObject);
        $em->persist($produit);
        $em->flush();
        return $mediaObject;
    }
}