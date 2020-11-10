<?php

namespace App\Entity;

use App\Controller\TopProducts;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\AddPanierItem;
use App\Controller\GetUserByProducts;
use App\Repository\ItemPanierRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(collectionOperations={
 *      "get",
 *      "post",
 *      "getTop"={
 *          "method"="GET",
 *          "path"="/top_produits/",
 *          "controller"=TopProducts::class   
 *      },
 *      "addPanierItem"={
 *          "method"="POST",
 *          "path"="/add_item_panier",
 *          "controller"=AddPanierItem::class   
 *      },
 *      "getByClients"={
 *          "method"="GET",
 *          "path"="/item_panier_byclients",
 *          "controller"=GetUserByProducts::class,
 *      }
 * })
 * @ORM\Entity(repositoryClass=ItemPanierRepository::class)
 */
class ItemPanier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Panier::class, inversedBy="itemPaniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPanier;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProduit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPanier(): ?Panier
    {
        return $this->idPanier;
    }

    public function setIdPanier(?Panier $idPanier): self
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
