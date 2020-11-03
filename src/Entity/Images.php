<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImagesRepository;
use App\Controller\CreateImageObjectAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @ApiResource(
 *     iri="http://schema.org/Images",
 *     normalizationContext={
 *         "Groups"={"Images_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateImageObjectAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "Images_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     },
 *                                     "label"={"type"="string"},
 *                                     "id_produit_id"={"type"=Produit::class}
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * 
 * 
 * )
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 * @Vich\Uploadable
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string|null
     * @ApiProperty(iri="http://schema.org/contentUrl")
     *@Groups({"Images_read"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    
    /**
     * @var File|null
     * @Assert\NotNull(groups={"Images_create"})
     * @UploadableField(mapping="product_image", fileNameProperty="location")
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    public $location;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProduit;

    /**
     * @ORM\Column(type="date",nullable=true)
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get the value of file
     *
     * @return  File|null
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @param  File|UploadedFile|null  $file
     *
     * @return  self
     */ 
    public function setFile(?File $file = null)
    {
        $this->file = $file;
        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable("now");
            //$this->location = 
        }
        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTimeInterface|null
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTimeInterface|null  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
