<?php

namespace App\Entity;

use App\Repository\ParticipationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationsRepository::class)
 */
class Participations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="participations")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="participations")
     */
    private $Poll;

    /**
     * @ORM\OneToMany(targetEntity=Choices::class, mappedBy="Participation", cascade={"persist", "remove", "merge"}, orphanRemoval=true))
     */
    private $choices;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPoll(): ?Polls
    {
        return $this->Poll;
    }

    public function setPoll(?Polls $Poll): self
    {
        $this->Poll = $Poll;

        return $this;
    }

    /**
     * @return Collection|Choices[]
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choices $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
            $choice->setParticipation($this);
        }

        return $this;
    }

    public function removeChoice(Choices $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
            // set the owning side to null (unless already changed)
            if ($choice->getParticipation() === $this) {
                $choice->setParticipation(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
