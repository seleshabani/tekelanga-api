<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\GetTotalVente;
use App\Controller\AddUserBaskets;
use App\Controller\GetSinglePanier;
use App\Controller\validateBaskets;
use App\Repository\PanierRepository;
use App\Controller\InvalidateBaskets;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 *   itemOperations={
 *      "get",
 *      "put",
 *      "delete",
 *      "add_basket_items"={
 *          "method"="POST",
 *          "path"="/panier/addForUser",
 *          "controller"=AddUserBaskets::class,
 *        },
 *      },collectionOperations={
 *          "post",
 *          "get",
 *          "invalidate_baskets":{
 *              "method"="GET",
 *              "path"="/paniers_invalide",
 *              "controller"=InvalidateBaskets::class,
 *          },
 *          "validate_baskets":{
 *              "method"="GET",
 *               "path"="/paniers_valide",
 *               "controller"=validateBaskets::class,
 *          },
 *          "totalVentes":{
 *              "method"="GET",
 *               "path"="/paniers_totalVentes",
 *               "controller"=GetTotalVente::class,
 *           },
 *          "get_SinglenonValide"={
 *          "method"="GET",
 *          "path"="/paniers/tel/secret",
 *          "controller"=GetSinglePanier::class,  
 *        },
 *    })
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="paniers")
     */
    private $idclient;

    /**
     * @ORM\Column(type="datetime", nullable=true,options={"default"="now()"})
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_validation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix_total;

    /**
     * @ORM\ManyToOne(targetEntity=Agent::class, inversedBy="PaniersValider")
     */
    private $idAgent;

    /**
     * @ORM\Column(type="boolean", nullable=true,options={"default"=false})
     */
    private $valide;

    /**
     * @ORM\Column(type="boolean", nullable=true,options={"default"=false})
     */
    private $livrer;
    /**
     * @ORM\OneToMany(targetEntity=ItemPanier::class, mappedBy="idPanier", orphanRemoval=true,cascade={"persist"})
     */
    private $itemPaniers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secret;

    
    public function __construct()
    {
        $this->itemPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdclient(): ?Client
    {
        return $this->idclient;
    }

    public function setIdclient(?Client $idclient): self
    {
        $this->idclient = $idclient;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->date_validation;
    }

    public function setDateValidation(?\DateTimeInterface $date_validation): self
    {
        $this->date_validation = $date_validation;

        return $this;
    }

    public function getPrixTotal(): ?int
    {
        return $this->prix_total;
    }

    public function setPrixTotal(?int $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getIdAgent(): ?Agent
    {
        return $this->idAgent;
    }

    public function setIdAgent(?Agent $idAgent): self
    {
        $this->idAgent = $idAgent;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * @return Collection|ItemPanier[]
     */
    public function getItemPaniers(): Collection
    {
        return $this->itemPaniers;
    }

    public function addItemPanier(ItemPanier $itemPanier): self
    {
        if (!$this->itemPaniers->contains($itemPanier)) {
            $this->itemPaniers[] = $itemPanier;
            $itemPanier->setIdPanier($this);
        }

        return $this;
    }

    public function removeItemPanier(ItemPanier $itemPanier): self
    {
        if ($this->itemPaniers->contains($itemPanier)) {
            $this->itemPaniers->removeElement($itemPanier);
            // set the owning side to null (unless already changed)
            if ($itemPanier->getIdPanier() === $this) {
                $itemPanier->setIdPanier(null);
            }
        }

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get the value of livrer
     */ 
    public function getLivrer()
    {
        return $this->livrer;
    }

    /**
     * Set the value of livrer
     *
     * @return  self
     */ 
    public function setLivrer($livrer)
    {
        $this->livrer = $livrer;

        return $this;
    }
}
