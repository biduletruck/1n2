<?php

namespace App\Entity;

use App\Repository\AncvRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AncvRepository::class)
 */
class Ancv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Answers;


    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="ancvs")
     */
    private $User;

    public function __construct()
    {
        $this->CreatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswers(): ?bool
    {
        return $this->Answers;
    }

    public function setAnswers(bool $Answers): self
    {
        $this->Answers = $Answers;

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

    public function getUser(): ?Users
    {
        return $this->User;
    }

    public function setUser(?Users $User): self
    {
        $this->User = $User;

        return $this;
    }
}
