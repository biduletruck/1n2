<?php

namespace App\Entity;

use App\Repository\CPParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CPParticipationRepository::class)
 */
class CPParticipation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CPConcoursPhotos::class, inversedBy="cPParticipations")
     */
    private $ConcoursPhotos;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="cPParticipations")
     */
    private $User;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

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

    public function getUser(): ?Users
    {
        return $this->User;
    }

    public function setUser(?Users $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }


}
