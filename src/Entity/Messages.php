<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 */
class Messages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_expediteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $exp_telephone;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExpediteur(): ?string
    {
        return $this->nom_expediteur;
    }

    public function setNomExpediteur(string $nom_expediteur): self
    {
        $this->nom_expediteur = $nom_expediteur;

        return $this;
    }

    public function getExpTelephone(): ?string
    {
        return $this->exp_telephone;
    }

    public function setExpTelephone(string $exp_telephone): self
    {
        $this->exp_telephone = $exp_telephone;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
