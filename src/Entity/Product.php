<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Product
{

    const STATUS = [
        0 => 'indisponible',
        1 => 'disponible',
        3 => 'sur commmande'
    ];

    const STATE = [
        0 => 'neuf',
        1 => 'occasion',
    ];
  


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->options = new ArrayCollection();
    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     */
    private $id;


    /**
     *  @var File|null
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="filename")
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null   
     */
    private $filename;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups("product:read")
     */
    private $libelle;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("product:read")
     */
    private $reference;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $createdAt;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $quality_checking;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Option", mappedBy="products")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fabricant", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("product:read")
     */
    private $fabricant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="products")
     * @Groups("product:read")
     */
    private $categories;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Specification", cascade={"persist", "remove"})
     */
    //private $specification;


     //////////////// HANDLER ID PRODUCT /////////////////////////

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



    //////////////// HANDLER LIBELLE PRODUCT /////////////////////////


    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->libelle);
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }


    //////////////// HANDLER REF PRODUCT /////////////////////////


    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }



    //////////////// HANDLER DESCRIPTION PRODUCT /////////////////////////

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }


    //////////////// HANDLER CREATED DATE PRODUCT /////////////////////////

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @return self
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime();
        return $this;
    }



    //////////////// HANDLER PRICE PRODUCT /////////////////////////


    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;
        return $this;
    }


    public function getFormatedPrice(): string
    {
        return number_format($this->price, 0, '', ' ');
    }


    //////////////// HANDLER STATUS PRODUCT /////////////////////////


    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getStatusType(): string
    {
        return self::STATUS[$this->status];
    }


    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    //////////////// HANDLER STATE PRODUCT /////////////////////////

    public function getState(): ?int
    {
        return $this->state;
    }

    public function getStateType(): string
    {
        return self::STATE[$this->state];
    }

    public function setState(int $state): self
    {
        $this->state = $state;
        return $this;
    }



    //////////////// HANDLER WIDTH PRODUCT /////////////////////////


    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(?string $width): Product
    {
        $this->width = $width;
        return $this;
    }



    //////////////// HANDLER HEIGHT PRODUCT /////////////////////////


    /**
     * @return string|null
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param string|null $height
     * @return self
     */
    public function setHeight(?string $height): self
    {
        $this->height = $height;
        return $this;
    }



    //////////////// HANDLER WEIGHT PRODUCT /////////////////////////

    /**
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string|null $weight
     * @return self
     */
    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;
        return $this;
    }



    //////////////// HANDLER QUALITY_CHECK PRODUCT /////////////////////////


    /**
     * @return boolean|null
     */
    public function getQualityChecking(): ?bool
    {
        return $this->quality_checking;
    }


    public function setQualityChecking(bool $quality_checking): self
    {
        $this->quality_checking = $quality_checking;
        return $this;
    }


    //////////////// HANDLER FABRICANT :RELATION  /////////////////////////



    public function getFabricant(): ?Fabricant
    {
        return $this->fabricant;
    }


    public function setFabricant(?Fabricant $fabricant): self
    {
        $this->fabricant = $fabricant;
        return $this;
    }


    //////////////// HANDLER CATEGORY :RELATION /////////////////////////


    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }




    //////////////// HANDLER OPTIONS :RELATION /////////////////////////

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    /**
     * @param Option $option
     */
    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProduct($this);
        }
        return $this;
    }

    /**
     * @param Option $option
     */
    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $option->removeProduct($this);
        }
        return $this;
    }


 


    //////////////// HANDLER IMAGE PRODUCT /////////////////////////


    /**
     * Get the value of imageFile
     * @return  File|null
     */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    /**
     * Set the value of imageFile
     * @param File|null $imageFile
     */ 
    public function setImageFile(?File $imageFile): Product
    {
        $this->imageFile = $imageFile;
        return $this;
    }



    /**
     * Get the value of filename
     * @return  string|null
     */ 
    public function getFilename(): ?string
    {
        return $this->filename;
    }



    /**
     * Set the value of filename
     * @param  string|null  $filename
     */ 
    public function setFilename(?string $filename): Product
    {
        $this->filename = $filename;
        return $this;
    }

   



   
}
