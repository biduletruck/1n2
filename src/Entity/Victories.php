<?php

namespace App\Entity;

use App\Repository\VictoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VictoriesRepository::class)
 */
class Victories
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
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=Matches::class, mappedBy="Victory")
     */
    private $matches;

    /**
     * @ORM\OneToMany(targetEntity=Predictions::class, mappedBy="Predict")
     */
    private $predictions;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
        $this->predictions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|Matches[]
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matches $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setVictory($this);
        }

        return $this;
    }

    public function removeMatch(Matches $match): self
    {
        if ($this->matches->contains($match)) {
            $this->matches->removeElement($match);
            // set the owning side to null (unless already changed)
            if ($match->getVictory() === $this) {
                $match->setVictory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Name;
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
            $prediction->setPredict($this);
        }

        return $this;
    }

    public function removePrediction(Predictions $prediction): self
    {
        if ($this->predictions->contains($prediction)) {
            $this->predictions->removeElement($prediction);
            // set the owning side to null (unless already changed)
            if ($prediction->getPredict() === $this) {
                $prediction->setPredict(null);
            }
        }

        return $this;
    }
}
