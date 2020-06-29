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
     * @ORM\Column(type="string", length=255)
     * @Groups("category:read")
     */
    private $reference ;

    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fabricant", inversedBy="categories")
     */
    private $fabricants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="categories")
     */
    private $products;



    public function __construct()
    {
        $this->fabricants = new ArrayCollection();
        $this->products = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }


    //////////////// HANDLER NAME CATEGORY /////////////////////////

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


    //////////////// HANDLER DESCRIPTION CATEGORY /////////////////////////


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
     * Renvoie le nombre de produits associer
     * @return integer
     * @Groups("category:read")
     */
    public function getCountProducts(): int
    {
        return count($this->products);
    }



    


    //////////////// HANDLER FABRICANT CATEGORY /////////////////////////

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


    //////////////// HANDLER REFERENCE CATEGORY /////////////////////////


    /**
     * Get the value of reference
     */ 
    public function getReference(): ?string
    {   
        return $this->reference;
    }


    /**
     * Set the value of reference
     *
     * @return  self
     */ 
    public function setReference( string $reference)
    {
        $this->reference = $reference;
        return $this;
    }



    //////////////// HANDLER PRODUCT :RELATION /////////////////////////


    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeCategory($this);
        }

        return $this;
    }
}
