<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fabricant", mappedBy="category")
     */
    private $fabricants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="categories")
     */
    private $Products;

    public function __construct()
    {
        $this->fabricants = new ArrayCollection();
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
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
            $fabricant->setCategory($this);
        }

        return $this;
    }

    public function removeFabricant(Fabricant $fabricant): self
    {
        if ($this->fabricants->contains($fabricant)) {
            $this->fabricants->removeElement($fabricant);
            // set the owning side to null (unless already changed)
            if ($fabricant->getCategory() === $this) {
                $fabricant->setCategory(null);
            }
        }

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

    public function removeProduct(Product $product): self
    {
        if ($this->Products->contains($product)) {
            $this->Products->removeElement($product);
        }

        return $this;
    }
}
