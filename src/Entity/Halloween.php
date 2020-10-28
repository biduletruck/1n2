<?php

namespace App\Entity;

use App\Repository\HalloweenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HalloweenRepository::class)
 */
class Halloween
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="halloweens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest6;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest7;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest8;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest9;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quest10;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finishedAt;

    public function __construct()
    {
//        $this->createdAt = new \DateTime();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getQuest1(): ?int
    {
        return $this->Quest1;
    }

    public function setQuest1(int $Quest1): self
    {
        $this->Quest1 = $Quest1;

        return $this;
    }

    public function getQuest2(): ?int
    {
        return $this->Quest2;
    }

    public function setQuest2(?int $Quest2): self
    {
        $this->Quest2 = $Quest2;

        return $this;
    }

    public function getQuest3(): ?int
    {
        return $this->Quest3;
    }

    public function setQuest3(?int $Quest3): self
    {
        $this->Quest3 = $Quest3;

        return $this;
    }

    public function getQuest4(): ?int
    {
        return $this->Quest4;
    }

    public function setQuest4(?int $Quest4): self
    {
        $this->Quest4 = $Quest4;

        return $this;
    }

    public function getQuest5(): ?int
    {
        return $this->Quest5;
    }

    public function setQuest5(?int $Quest5): self
    {
        $this->Quest5 = $Quest5;

        return $this;
    }

    public function getQuest6(): ?int
    {
        return $this->Quest6;
    }

    public function setQuest6(?int $Quest6): self
    {
        $this->Quest6 = $Quest6;

        return $this;
    }

    public function getQuest7(): ?int
    {
        return $this->Quest7;
    }

    public function setQuest7(?int $Quest7): self
    {
        $this->Quest7 = $Quest7;

        return $this;
    }

    public function getQuest8(): ?int
    {
        return $this->Quest8;
    }

    public function setQuest8(?int $Quest8): self
    {
        $this->Quest8 = $Quest8;

        return $this;
    }

    public function getQuest9(): ?int
    {
        return $this->Quest9;
    }

    public function setQuest9(?int $Quest9): self
    {
        $this->Quest9 = $Quest9;

        return $this;
    }

    public function getQuest10(): ?int
    {
        return $this->Quest10;
    }

    public function setQuest10(?int $Quest10): self
    {
        $this->Quest10 = $Quest10;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTimeInterface $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

}
