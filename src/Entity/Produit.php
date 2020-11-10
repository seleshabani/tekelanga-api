<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use App\Controller\GetProductsWithImages;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(collectionOperations={
 *                  "get",
 *                  "post",
 *                  "getwithimages"={
 *                      "method"="GET",
 *                      "path"="/produits_withimages",
 *                      "controller"=GetProductsWithImages::class,
 *                  }
 * 
 * })
 * @ApiFIlter(SearchFilter::class,properties={"nom":"word_start"})
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="Produits")
     */
    private $idCategories;

    /**
     * @ORM\OneToOne(targetEntity=Stock::class, mappedBy="idProduit", cascade={"remove"})
     */
    private $stock;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, mappedBy="idProduit")
     * @ApiProperty(readable=true)
     */
    private $images;

    public function __construct()
    {
        //$this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdCategories(): ?Categories
    {
        return $this->idCategories;
    }

    public function setIdCategories(?Categories $idCategories): self
    {
        $this->idCategories = $idCategories;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        // set (or unset) the owning side of the relation if necessary
        $newIdProduit = null === $stock ? null : $this;
        if ($stock->getIdProduit() !== $newIdProduit) {
            $stock->setIdProduit($newIdProduit);
        }

        return $this;
    }

    /**
     * Get the value of images
     */ 
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function setImages(Images $images)
    {
        $this->images = $images;

        return $this;
    }
}
