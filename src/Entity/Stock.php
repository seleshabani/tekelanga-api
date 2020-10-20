<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @ORM\Column(type="integer")
     * la quantité initial
     */
    private $stockInit;

    /**
     * @ORM\Column(type="integer")
     * la quantité restante en stock
     */
    private $stockRest;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_unitaire;

    /**
     * @ORM\Column(type="integer")
     * Répresente le total du stock initial
     */
    private $totalStockInit;

    /**
     * @ORM\Column(type="integer")
     * Répresente le total du stock restant
     */
    private $totalStockRest;
    
    /**
     * @ORM\OneToOne(targetEntity=Produit::class, inversedBy="stock", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStockRest(): ?int
    {
        return $this->stockRest;
    }

    public function setStockRest(int $stockRest): self
    {
        $this->stockRest = $stockRest;

        return $this;
    }

    public function getPrixUnitaire(): ?int
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(int $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getTotalStockInit(): ?int
    {
        return $this->totalStockInit;
    }

    public function setTotalStockInit(int $totalStockInit): self
    {
        $this->totalStockInit = $totalStockInit;

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

    /**
     * Get la quantité initial
     */ 
    public function getStockInit()
    {
        return $this->stockInit;
    }

    /**
     * Set la quantité initial
     *
     * @return  self
     */ 
    public function setStockInit($stockInit)
    {
        $this->stockInit = $stockInit;

        return $this;
    }

    /**
     * Get répresente le total du stock restant
     */ 
    public function getTotalStockRest()
    {
        return $this->totalStockRest;
    }

    /**
     * Set répresente le total du stock restant
     *
     * @return  self
     */ 
    public function setTotalStockRest($totalStockRest)
    {
        $this->totalStockRest = $totalStockRest;

        return $this;
    }
}
