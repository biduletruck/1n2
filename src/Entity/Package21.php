<?php

namespace App\Entity;

use App\Repository\Package21Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Package21Repository::class)
 */
class Package21
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
    private $titlePackage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $refPackage;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPackage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Commande21::class, mappedBy="package", orphanRemoval=true)
     */
    private $commande21s;

    public function __construct()
    {
        $this->commande21s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlePackage(): ?string
    {
        return $this->titlePackage;
    }

    public function setTitlePackage(string $titlePackage): self
    {
        $this->titlePackage = $titlePackage;

        return $this;
    }

    public function getRefPackage(): ?string
    {
        return $this->refPackage;
    }

    public function setRefPackage(string $refPackage): self
    {
        $this->refPackage = $refPackage;

        return $this;
    }

    public function getDescriptionPackage(): ?string
    {
        return $this->descriptionPackage;
    }

    public function setDescriptionPackage(string $descriptionPackage): self
    {
        $this->descriptionPackage = $descriptionPackage;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Commande21[]
     */
    public function getCommande21s(): Collection
    {
        return $this->commande21s;
    }

    public function addCommande21(Commande21 $commande21): self
    {
        if (!$this->commande21s->contains($commande21)) {
            $this->commande21s[] = $commande21;
            $commande21->setPackage($this);
        }

        return $this;
    }

    public function removeCommande21(Commande21 $commande21): self
    {
        if ($this->commande21s->removeElement($commande21)) {
            // set the owning side to null (unless already changed)
            if ($commande21->getPackage() === $this) {
                $commande21->setPackage(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titlePackage;
    }
}
