<?php

namespace App\Entity;

use App\Repository\ChoicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChoicesRepository::class)
 */
class Choices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="choices")
     */
    private $Question;

    /**
     * @ORM\ManyToOne(targetEntity=Participations::class, inversedBy="choices")
     */
    private $Participation;

    /**
     * @ORM\ManyToMany(targetEntity=Answers::class, inversedBy="choices")
     */
    private $Answer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    public function __construct()
    {
        $this->Answer = new ArrayCollection();
        $this->CreatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Questions
    {
        return $this->Question;
    }

    public function setQuestion(?Questions $Question): self
    {
        $this->Question = $Question;

        return $this;
    }

    public function getParticipation(): ?Participations
    {
        return $this->Participation;
    }

    public function setParticipation(?Participations $Participation): self
    {
        $this->Participation = $Participation;

        return $this;
    }

    /**
     * @return Collection|Answers[]
     */
    public function getAnswer(): Collection
    {
        return $this->Answer;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->Answer->contains($answer)) {
            $this->Answer[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->Answer->contains($answer)) {
            $this->Answer->removeElement($answer);
        }

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
}
