<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Predictions::class, mappedBy="User")
     */
    private $predictions;


    /**
     * @ORM\OneToMany(targetEntity=BbqEvent::class, mappedBy="salarie")
     */
    private $bbqEvents;

    public function __construct()
    {
        $this->predictions = new ArrayCollection();
        $this->bbqEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $prediction->setUser($this);
        }

        return $this;
    }

    public function removePrediction(Predictions $prediction): self
    {
        if ($this->predictions->contains($prediction)) {
            $this->predictions->removeElement($prediction);
            // set the owning side to null (unless already changed)
            if ($prediction->getUser() === $this) {
                $prediction->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }


    /**
     * @return Collection|BbqEvent[]
     */
    public function getBbqEvents(): Collection
    {
        return $this->bbqEvents;
    }

    public function addBbqEvent(BbqEvent $bbqEvent): self
    {
        if (!$this->bbqEvents->contains($bbqEvent)) {
            $this->bbqEvents[] = $bbqEvent;
            $bbqEvent->setSalarie($this);
        }

        return $this;
    }

    public function removeBbqEvent(BbqEvent $bbqEvent): self
    {
        if ($this->bbqEvents->contains($bbqEvent)) {
            $this->bbqEvents->removeElement($bbqEvent);
            // set the owning side to null (unless already changed)
            if ($bbqEvent->getSalarie() === $this) {
                $bbqEvent->setSalarie(null);
            }
        }

        return $this;
    }
}
