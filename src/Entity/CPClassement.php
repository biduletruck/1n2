<?php

namespace App\Entity;

use App\Repository\CPClassementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CPClassementRepository::class)
 */
class CPClassement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CPConcoursPhotos::class, inversedBy="cPClassements")
     */
    private $ConcoursPhotos;

    /**
     * @ORM\ManyToOne(targetEntity=CPImages::class, inversedBy="cPClassements")
     */
    private $Image;

    /**
     * @ORM\Column(type="integer")
     */
    private $ClassementPhoto;

    /**
     * @ORM\Column(type="integer")
     */
    private $NombrePoints;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $UpdatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=users::class, inversedBy="cPClassements")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=CPClassement::class, inversedBy="cPClassements")
     */
    private $Classement;

    /**
     * @ORM\OneToMany(targetEntity=CPClassement::class, mappedBy="Classement")
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

    public function getConcoursPhotos(): ?CPConcoursPhotos
    {
        return $this->ConcoursPhotos;
    }

    public function setConcoursPhotos(?CPConcoursPhotos $ConcoursPhotos): self
    {
        $this->ConcoursPhotos = $ConcoursPhotos;

        return $this;
    }

    public function getImage(): ?CPImages
    {
        return $this->Image;
    }

    public function setImage(?CPImages $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getClassementPhoto(): ?int
    {
        return $this->ClassementPhoto;
    }

    public function setClassementPhoto(int $ClassementPhoto): self
    {
        $this->ClassementPhoto = $ClassementPhoto;

        return $this;
    }

    public function getNombrePoints(): ?int
    {
        return $this->NombrePoints;
    }

    public function setNombrePoints(int $NombrePoints): self
    {
        $this->NombrePoints = $NombrePoints;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->User;
    }

    public function setUser(?users $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getClassement(): ?self
    {
        return $this->Classement;
    }

    public function setClassement(?self $Classement): self
    {
        $this->Classement = $Classement;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCPClassements(): Collection
    {
        return $this->cPClassements;
    }

    public function addCPClassement(self $cPClassement): self
    {
        if (!$this->cPClassements->contains($cPClassement)) {
            $this->cPClassements[] = $cPClassement;
            $cPClassement->setClassement($this);
        }

        return $this;
    }

    public function removeCPClassement(self $cPClassement): self
    {
        if ($this->cPClassements->removeElement($cPClassement)) {
            // set the owning side to null (unless already changed)
            if ($cPClassement->getClassement() === $this) {
                $cPClassement->setClassement(null);
            }
        }

        return $this;
    }
}
