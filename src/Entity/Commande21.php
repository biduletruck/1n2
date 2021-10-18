<?php

namespace App\Entity;

use App\Repository\Commande21Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Negative;

/**
 * @ORM\Entity(repositoryClass=Commande21Repository::class)
 */
class Commande21
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commande21s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salarie;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $emailSalarie;

    /**
     * @ORM\ManyToOne(targetEntity=Package21::class, inversedBy="commande21s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $package;

    /**
     * @ORM\ManyToOne(targetEntity=Cheque21::class, inversedBy="commande21s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cheque;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSalarie(): ?Users
    {
        return $this->salarie;
    }

    public function setSalarie(?Users $salarie): self
    {
        $this->salarie = $salarie;

        return $this;
    }

    public function getEmailSalarie(): ?string
    {
        return $this->emailSalarie;
    }

    public function setEmailSalarie(string $emailSalarie): self
    {
        $this->emailSalarie = $emailSalarie;

        return $this;
    }

    public function getPackage(): ?Package21
    {
        return $this->package;
    }

    public function setPackage(?Package21 $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function getCheque(): ?Cheque21
    {
        return $this->cheque;
    }

    public function setCheque(?Cheque21 $cheque): self
    {
        $this->cheque = $cheque;

        return $this;
    }
}
