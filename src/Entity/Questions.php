<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Wording;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="questions")
     */
    private $Poll;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="Question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=Choices::class, mappedBy="Question")
     */
    private $choices;

    /**
     * @ORM\Column(type="integer")
     */
    private $QuestionNumber;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->choices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Answers[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

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
            $choice->setQuestion($this);
        }

        return $this;
    }

    public function removeChoice(Choices $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
            // set the owning side to null (unless already changed)
            if ($choice->getQuestion() === $this) {
                $choice->setQuestion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Poll . " - Question N° " . $this->Wording;
    }

    public function getQuestionNumber(): ?int
    {
        return $this->QuestionNumber;
    }

    public function setQuestionNumber(int $QuestionNumber): self
    {
        $this->QuestionNumber = $QuestionNumber;

        return $this;
    }
}
