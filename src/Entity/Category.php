<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     * @Groups("category:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     * @Groups("category:read")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="categories")
     */
    private $Products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fabricant", inversedBy="categories")
     */
    private $fabricants;

    public function __construct()
    {
        $this->Products = new ArrayCollection();
        $this->fabricants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->name);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

   

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->Products->contains($product)) {
            $this->Products[] = $product;
        }

        return $this;
    }

    /**
     * Renvoie le nombre de produits associer
     * @return integer
     * @Groups("category:read")
     */
    public function getCountProducts():int
    {
        return count($this->Products);
    }
    
    public function removeProduct(Product $product): self
    {
        if ($this->Products->contains($product)) {
            $this->Products->removeElement($product);
        }

        return $this;
    }

    /**
     * @return Collection|Fabricant[]
     */
    public function getFabricants(): Collection
    {
        return $this->fabricants;
    }

    public function addFabricant(Fabricant $fabricant): self
    {
        if (!$this->fabricants->contains($fabricant)) {
            $this->fabricants[] = $fabricant;
        }

        return $this;
    }

    public function removeFabricant(Fabricant $fabricant): self
    {
        if ($this->fabricants->contains($fabricant)) {
            $this->fabricants->removeElement($fabricant);
        }

        return $this;
    }
}
