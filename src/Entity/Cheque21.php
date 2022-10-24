<?php

namespace App\Entity;

use App\Repository\Cheque21Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Cheque21Repository::class)
 */
class Cheque21
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
    private $titleCheque;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionCheque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageCheque;

    /**
     * @ORM\OneToMany(targetEntity=Commande21::class, mappedBy="cheque", orphanRemoval=true)
     */
    private $commande21s;

    /**
     * @ORM\Column(type="boolean")
     */
    private $profile;

    public function __construct()
    {
        $this->commande21s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleCheque(): ?string
    {
        return $this->titleCheque;
    }

    public function setTitleCheque(string $titleCheque): self
    {
        $this->titleCheque = $titleCheque;

        return $this;
    }

    public function getDescriptionCheque(): ?string
    {
        return $this->descriptionCheque;
    }

    public function setDescriptionCheque(string $descriptionCheque): self
    {
        $this->descriptionCheque = $descriptionCheque;

        return $this;
    }

    public function getImageCheque(): ?string
    {
        return $this->imageCheque;
    }

    public function setImageCheque(string $imageCheque): self
    {
        $this->imageCheque = $imageCheque;

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
            $commande21->setCheque($this);
        }

        return $this;
    }

    public function removeCommande21(Commande21 $commande21): self
    {
        if ($this->commande21s->removeElement($commande21)) {
            // set the owning side to null (unless already changed)
            if ($commande21->getCheque() === $this) {
                $commande21->setCheque(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titleCheque;
    }

    public function getProfile(): ?bool
    {
        return $this->profile;
    }

    public function setProfile(bool $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function isProfile(): ?bool
    {
        return $this->profile;
    }
}
