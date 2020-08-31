<?php

namespace App\Entity;

use App\Repository\BbqRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BbqRepository::class)
 */
class Bbq
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
    private $Event;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateEvent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateLimit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="bbqs")
     */
    private $Createdby;

    /**
     * @ORM\OneToMany(targetEntity=BbqEvent::class, mappedBy="newBbq")
     */
    private $bbqEvents;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->Event;
    }

    public function setEvent(string $Event): self
    {
        $this->Event = $Event;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->DateEvent;
    }

    public function setDateEvent(\DateTimeInterface $DateEvent): self
    {
        $this->DateEvent = $DateEvent;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateLimit(): ?\DateTimeInterface
    {
        return $this->DateLimit;
    }

    public function setDateLimit(\DateTimeInterface $DateLimit): self
    {
        $this->DateLimit = $DateLimit;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getCreatedby(): ?Users
    {
        return $this->Createdby;
    }

    public function setCreatedby(?Users $Createdby): self
    {
        $this->Createdby = $Createdby;

        return $this;
    }

    public function setNewBbq(?self $newBbq): self
    {
        $this->newBbq = $newBbq;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getBbqEvents(): Collection
    {
        return $this->bbqEvents;
    }

    public function __toString()
    {
        return $this->Event;
    }


}
