<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="date_creation")
     */
    private $idclient;

    /**
     * @ORM\Column(type="datetime", length=255)
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @ORM\OneToMany(targetEntity=ItemPanier::class, mappedBy="idPanier", orphanRemoval=true)
     */
    private $itemPaniers;

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

    public function getDateCreation(): ?string
    {
        return $this->date_creation;
    }

    public function setDateCreation(string $date_creation): self
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
}
