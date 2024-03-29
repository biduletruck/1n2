<?php

namespace App\Entity;

use App\Repository\PredictionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PredictionsRepository::class)
 */
class Predictions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Matches::class, inversedBy="predictions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Game;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="predictions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;



    /**
     * @ORM\Column(type="string")
     */
    private $HomeResult;

    /**
     * @ORM\Column(type="string")
     */
    private $VisitorResult;

    /**
     * @ORM\ManyToOne(targetEntity=Victories::class, inversedBy="predictions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Predict;

    /**
     * @ORM\Column(type="integer")
     */
    private $points = 0;

    public function __construct()
    {
        $this->CreatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Matches
    {
        return $this->Game;
    }

    public function setGame(?Matches $Game): self
    {
        $this->Game = $Game;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    

    public function getHomeResult(): ?int
    {
        return $this->HomeResult;
    }

    public function setHomeResult(int $HomeResult): self
    {
        $this->HomeResult = $HomeResult;

        return $this;
    }

    public function getVisitorResult(): ?int
    {
        return $this->VisitorResult;
    }

    public function setVisitorResult(int $VisitorResult): self
    {
        $this->VisitorResult = $VisitorResult;

        return $this;
    }

    public function getPredict(): ?Victories
    {
        return $this->Predict;
    }

    public function setPredict(?Victories $Predict): self
    {
        $this->Predict = $Predict;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
