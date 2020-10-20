<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ProduitsByCategorie;
/**
 * @ApiResource(
 *  itemOperations={
 *      "get",
 *      "put",
 *      "delete",
 *      "getPostsByCategorie"={
 *          "method"="GET",
 *          "path"="/categories/{id}/posts",
 *          "controller"=ProduitsByCategorie::class,
 *        }
 *  }
 * )
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detail;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="idCategories")
     */
    private $Produits;

    public function __construct()
    {
        $this->Produits = new ArrayCollection();
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

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits[] = $produit;
            $produit->setIdCategories($this);
        }

        return $this;
    }
    
    public function removeProduit(Produit $produit): self
    {
        if ($this->Produits->contains($produit)) {
            $this->Produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getIdCategories() === $this) {
                $produit->setIdCategories(null);
            }
        }
        return $this;
    }
}
