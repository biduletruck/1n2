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





    public function __construct()
    {

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

}
