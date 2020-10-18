<?php

namespace App\Entity;

use App\Entity\Client;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AddresseRepository::class)
 */
class Addresse
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
    private $ville;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $quartier;

     /**
     * @ORM\Column(type="string", length=100)
     */
    private $avenue;
    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="idAddresse")
     */
    private $clients;
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of commune
     */ 
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set the value of commune
     *
     * @return  self
     */ 
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get the value of quartier
     */ 
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set the value of quartier
     *
     * @return  self
     */ 
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }
    /**
     * Get the value of quartier
     */ 
    public function getAvenue()
    {
        return $this->avenue;
    }

    /**
     * Set the value of Avenue
     *
     * @return  self
     */ 
    public function setAvenue($avenue)
    {
        $this->avenue = $avenue;

        return $this;
    }
    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of clients
     *  @return Collection|Client[]
     */ 
    public function getClients()
    {
        return $this->clients;
    }
}
