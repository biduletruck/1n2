<?php

namespace App\Entity;

use App\Repository\CPImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CPImagesRepository::class)
 */
class CPImages
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
    private $NonParticipant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CPConcoursPhotos::class, inversedBy="cPImages")
     */
    private $ConcoursPhotos;

    /**
     * @ORM\OneToMany(targetEntity=CPClassement::class, mappedBy="Image")
     */
    private $cPClassements;

    public function __construct()
    {
        $this->cPClassements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNonParticipant(): ?string
    {
        return $this->NonParticipant;
    }

    public function setNonParticipant(string $NonParticipant): self
    {
        $this->NonParticipant = $NonParticipant;

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

    public function getConcoursPhotos(): ?CPConcoursPhotos
    {
        return $this->ConcoursPhotos;
    }

    public function setConcoursPhotos(?CPConcoursPhotos $ConcoursPhotos): self
    {
        $this->ConcoursPhotos = $ConcoursPhotos;

        return $this;
    }

    /**
     * @return Collection<int, CPClassement>
     */
    public function getCPClassements(): Collection
    {
        return $this->cPClassements;
    }

    public function addCPClassement(CPClassement $cPClassement): self
    {
        if (!$this->cPClassements->contains($cPClassement)) {
            $this->cPClassements[] = $cPClassement;
            $cPClassement->setImage($this);
        }

        return $this;
    }

    public function removeCPClassement(CPClassement $cPClassement): self
    {
        if ($this->cPClassements->removeElement($cPClassement)) {
            // set the owning side to null (unless already changed)
            if ($cPClassement->getImage() === $this) {
                $cPClassement->setImage(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNonParticipant();
    }
}
