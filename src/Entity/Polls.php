<?php

namespace App\Entity;

use App\Repository\PollsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PollsRepository::class)
 */
class Polls
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
    private $Title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Participations::class, mappedBy="Poll")
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, mappedBy="Poll")
     */
    private $questions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $openAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $closedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Consignes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $DefaultPoll;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Identifiant;


    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->CreatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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

    /**
     * @return Collection|Participations[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participations $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setPoll($this);
        }

        return $this;
    }

    public function removeParticipation(Participations $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getPoll() === $this) {
                $participation->setPoll(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Questions[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setPoll($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getPoll() === $this) {
                $question->setPoll(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Title;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getOpenAt(): ?\DateTimeInterface
    {
        return $this->openAt;
    }

    public function setOpenAt(?\DateTimeInterface $openAt): self
    {
        $this->openAt = $openAt;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closedAt;
    }

    public function setClosedAt(?\DateTimeInterface $closedAt): self
    {
        $this->closedAt = $closedAt;

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

    public function getConsignes(): ?string
    {
        return $this->Consignes;
    }

    public function setConsignes(?string $Consignes): self
    {
        $this->Consignes = $Consignes;

        return $this;
    }

    public function isDefaultPoll(): ?bool
    {
        return $this->DefaultPoll;
    }

    public function setDefaultPoll(bool $DefaultPoll): self
    {
        $this->DefaultPoll = $DefaultPoll;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->Identifiant;
    }

    public function setIdentifiant(?string $Identifiant): self
    {
        $this->Identifiant = $Identifiant;

        return $this;
    }
}
