<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswersRepository::class)
 */
class Answers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="answers")
     */
    private $Question;

    /**
     * @ORM\Column(type="text")
     */
    private $Wording;

    /**
     * @ORM\ManyToMany(targetEntity=Choices::class, mappedBy="Answer")
     */
    private $choices;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $AnswerNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $AnswerValue;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
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

    public function getWording(): ?string
    {
        return $this->Wording;
    }

    public function setWording(string $Wording): self
    {
        $this->Wording = $Wording;

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
            $choice->addAnswer($this);
        }

        return $this;
    }

    public function removeChoice(Choices $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
            $choice->removeAnswer($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Wording;
    }

    public function getAnswerNumber(): ?int
    {
        return $this->AnswerNumber;
    }

    public function setAnswerNumber(int $AnswerNumber): self
    {
        $this->AnswerNumber = $AnswerNumber;

        return $this;
    }

    public function getAnswerValue(): ?int
    {
        return $this->AnswerValue;
    }

    public function setAnswerValue(int $AnswerValue): self
    {
        $this->AnswerValue = $AnswerValue;

        return $this;
    }
}
