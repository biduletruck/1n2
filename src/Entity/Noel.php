<?php

namespace App\Entity;

use App\Repository\NoelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NoelRepository::class)
 */
class Noel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="noels")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Colis::class, inversedBy="noels")
     */
    private $choixColis;

    /**
     * @ORM\ManyToOne(targetEntity=Cheques::class, inversedBy="noels")
     */
    private $choixCheque;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "L'émail '{{ value }}' n'est pas une adresse valide."
     * )
     */
    private $adresseMail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $optin;

    public function __construct()
    {
        $this->CreatedAt = new \DateTime();
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

    public function getChoixColis(): ?Colis
    {
        return $this->choixColis;
    }

    public function setChoixColis(?Colis $choixColis): self
    {
        $this->choixColis = $choixColis;

        return $this;
    }

    public function getChoixCheque(): ?Cheques
    {
        return $this->choixCheque;
    }

    public function setChoixCheque(?Cheques $choixCheque): self
    {
        $this->choixCheque = $choixCheque;

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

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(?string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getOptin(): ?bool
    {
        return $this->optin;
    }

    public function setOptin(?bool $optin): self
    {
        $this->optin = $optin;

        return $this;
    }

    public function isOptin(): ?bool
    {
        return $this->optin;
    }
}
