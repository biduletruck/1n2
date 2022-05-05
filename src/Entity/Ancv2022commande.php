<?php

namespace App\Entity;

use App\Repository\Ancv2022commandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Ancv2022commandeRepository::class)
 */
class Ancv2022commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ancv2022::class, inversedBy="User")
     */
    private $Cheque;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="ancv2022commandes")
     */
    private $User;

    public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheque(): ?Ancv2022
    {
        return $this->Cheque;
    }

    public function setCheque(?Ancv2022 $Cheque): self
    {
        $this->Cheque = $Cheque;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
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
