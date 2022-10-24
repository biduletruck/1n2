<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchesRepository::class)
 */
class Matches
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartTime;

    /**
     * @ORM\OneToMany(targetEntity=Predictions::class, mappedBy="Game")
     */
    private $predictions = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $HomeResult;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $VisitorResult;

    /**
     * @ORM\ManyToOne(targetEntity=Teams::class, inversedBy="HomeMatch")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Home;

    /**
     * @ORM\ManyToOne(targetEntity=Teams::class, inversedBy="VisitorMatch")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Visitor;

    /**
     * @ORM\ManyToOne(targetEntity=Victories::class, inversedBy="matches")
     */
    private $Victory;

    public function __construct()
    {
        $this->predictions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->StartTime;
    }

    public function setStartTime(\DateTimeInterface $StartTime): self
    {
        $this->StartTime = $StartTime;

        return $this;
    }

    /**
     * @return Collection|Predictions[]
     */
    public function getPredictions(): Collection
    {
        return $this->predictions;
    }

    public function addPrediction(Predictions $prediction): self
    {
        if (!$this->predictions->contains($prediction)) {
            $this->predictions[] = $prediction;
            $prediction->setGame($this);
        }

        return $this;
    }

    public function removePrediction(Predictions $prediction): self
    {
        if ($this->predictions->contains($prediction)) {
            $this->predictions->removeElement($prediction);
            // set the owning side to null (unless already changed)
            if ($prediction->getGame() === $this) {
                $prediction->setGame(null);
            }
        }

        return $this;
    }

    public function getHomeResult(): ?int
    {
        return $this->HomeResult;
    }

    public function setHomeResult(?int $HomeResult): self
    {
        $this->HomeResult = $HomeResult;

        return $this;
    }

    public function getVisitorResult(): ?int
    {
        return $this->VisitorResult;
    }

    public function setVisitorResult(?int $VisitorResult): self
    {
        $this->VisitorResult = $VisitorResult;

        return $this;
    }

    public function getHome(): ?Teams
    {
        return $this->Home;
    }

    public function setHome(?Teams $Home): self
    {
        $this->Home = $Home;

        return $this;
    }

    public function getVisitor(): ?Teams
    {
        return $this->Visitor;
    }

    public function setVisitor(?Teams $Visitor): self
    {
        $this->Visitor = $Visitor;

        return $this;
    }

    public function __toString()
    {
        return $this->Home . " vs " . $this->Visitor;
    }

    public function getVictory(): ?Victories
    {
        return $this->Victory;
    }

    public function setVictory(?Victories $Victory): self
    {
        $this->Victory = $Victory;

        return $this;
    }
}
