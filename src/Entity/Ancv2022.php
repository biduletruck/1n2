<?php

namespace App\Entity;

use App\Repository\Ancv2022Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Ancv2022Repository::class)
 */
class Ancv2022
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Activated;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Ancv2022commande::class, mappedBy="Cheque")
     */
    private $User;

    public function __construct()
    {
        $this->User = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getActivated(): ?bool
    {
        return $this->Activated;
    }

    public function setActivated(bool $Activated): self
    {
        $this->Activated = $Activated;

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

    /**
     * @return Collection<int, Ancv2022commande>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(Ancv2022commande $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User[] = $user;
            $user->setCheque($this);
        }

        return $this;
    }

    public function removeUser(Ancv2022commande $user): self
    {
        if ($this->User->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCheque() === $this) {
                $user->setCheque(null);
            }
        }

        return $this;
    }
}
