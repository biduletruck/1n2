<?php

namespace App\Entity;

use App\Repository\CPConcoursPhotosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CPConcoursPhotosRepository::class)
 */
class CPConcoursPhotos
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
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Identifiant;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $OpenAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $ClosedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $defaut;

    /**
     * @ORM\Column(type="integer")
     */
    private $Classement;

    /**
     * @ORM\OneToMany(targetEntity=CPImages::class, mappedBy="ConcoursPhotos")
     */
    private $cPImages;

    /**
     * @ORM\OneToMany(targetEntity=CPParticipation::class, mappedBy="ConcoursPhotos")
     */
    private $cPParticipations;

    /**
     * @ORM\OneToMany(targetEntity=CPClassement::class, mappedBy="ConcoursPhotos")
     */
    private $cPClassements;

    public function __construct()
    {
        $this->cPImages = new ArrayCollection();
        $this->cPParticipations = new ArrayCollection();
        $this->cPClassements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->Identifiant;
    }

    public function setIdentifiant(string $Identifiant): self
    {
        $this->Identifiant = $Identifiant;

        return $this;
    }

    public function getOpenAt(): ?\DateTimeImmutable
    {
        return $this->OpenAt;
    }

    public function setOpenAt(\DateTimeImmutable $OpenAt): self
    {
        $this->OpenAt = $OpenAt;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeImmutable
    {
        return $this->ClosedAt;
    }

    public function setClosedAt(\DateTimeImmutable $ClosedAt): self
    {
        $this->ClosedAt = $ClosedAt;

        return $this;
    }

    public function isDefaut(): ?bool
    {
        return $this->defaut;
    }

    public function setDefaut(bool $defaut): self
    {
        $this->defaut = $defaut;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->Classement;
    }

    public function setClassement(int $Classement): self
    {
        $this->Classement = $Classement;

        return $this;
    }

    /**
     * @return Collection<int, CPImages>
     */
    public function getCPImages(): Collection
    {
        return $this->cPImages;
    }

    public function addCPImage(CPImages $cPImage): self
    {
        if (!$this->cPImages->contains($cPImage)) {
            $this->cPImages[] = $cPImage;
            $cPImage->setConcoursPhotos($this);
        }

        return $this;
    }

    public function removeCPImage(CPImages $cPImage): self
    {
        if ($this->cPImages->removeElement($cPImage)) {
            // set the owning side to null (unless already changed)
            if ($cPImage->getConcoursPhotos() === $this) {
                $cPImage->setConcoursPhotos(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CPParticipation>
     */
    public function getCPParticipations(): Collection
    {
        return $this->cPParticipations;
    }

    public function addCPParticipation(CPParticipation $cPParticipation): self
    {
        if (!$this->cPParticipations->contains($cPParticipation)) {
            $this->cPParticipations[] = $cPParticipation;
            $cPParticipation->setConcoursPhotos($this);
        }

        return $this;
    }

    public function removeCPParticipation(CPParticipation $cPParticipation): self
    {
        if ($this->cPParticipations->removeElement($cPParticipation)) {
            // set the owning side to null (unless already changed)
            if ($cPParticipation->getConcoursPhotos() === $this) {
                $cPParticipation->setConcoursPhotos(null);
            }
        }

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
            $cPClassement->setConcoursPhotos($this);
        }

        return $this;
    }

    public function removeCPClassement(CPClassement $cPClassement): self
    {
        if ($this->cPClassements->removeElement($cPClassement)) {
            // set the owning side to null (unless already changed)
            if ($cPClassement->getConcoursPhotos() === $this) {
                $cPClassement->setConcoursPhotos(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitre();
    }
}
