<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AgentRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource()
 * @ApiFIlter(SearchFilter::class,properties={"mail":"exact","password":"exact"})
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Addresse::class)
     */
    private $idAddresse;

    /**
     * @ORM\OneToMany(targetEntity=Panier::class, mappedBy="idAgent")
     */
    private $PaniersValider;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
        $this->PaniersValider = new ArrayCollection();
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getIdAddress(): ?Addresse
    {
        return $this->idAddresse;
    }

    public function setIdAddress(?Addresse $idAddresse): self
    {
        $this->idAddresse = $idAddresse;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = password_hash($password,PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPaniersValider(): Collection
    {
        return $this->PaniersValider;
    }

    public function addPaniersValider(Panier $paniersValider): self
    {
        if (!$this->PaniersValider->contains($paniersValider)) {
            $this->PaniersValider[] = $paniersValider;
            $paniersValider->setIdAgent($this);
        }

        return $this;
    }

    public function removePaniersValider(Panier $paniersValider): self
    {
        if ($this->PaniersValider->contains($paniersValider)) {
            $this->PaniersValider->removeElement($paniersValider);
            // set the owning side to null (unless already changed)
            if ($paniersValider->getIdAgent() === $this) {
                $paniersValider->setIdAgent(null);
            }
        }

        return $this;
    }

    public function getIdAddresse(): ?Addresse
    {
        return $this->idAddresse;
    }

    public function setIdAddresse(?Addresse $idAddresse): self
    {
        $this->idAddresse = $idAddresse;

        return $this;
    }
}
