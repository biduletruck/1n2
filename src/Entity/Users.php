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

    /**
     * @ORM\OneToMany(targetEntity=Ancv::class, mappedBy="User")
     */
    private $ancvs;

    /**
     * @ORM\OneToMany(targetEntity=Noel::class, mappedBy="User")
     */
    private $noels;

    /**
     * @ORM\OneToMany(targetEntity=Participations::class, mappedBy="User")
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity=Halloween::class, mappedBy="User")
     */
    private $halloweens;

    /**
     * @ORM\OneToMany(targetEntity=HalloweenCheck::class, mappedBy="User")
     */
    private $halloweenChecks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntree;



    public function __construct()
    {
        $this->predictions = new ArrayCollection();
        $this->bbqEvents = new ArrayCollection();
        $this->ancvs = new ArrayCollection();
        $this->noels = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->halloweens = new ArrayCollection();
        $this->halloweenChecks = new ArrayCollection();
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

    /**
     * @return Collection|Ancv[]
     */
    public function getAncvs(): Collection
    {
        return $this->ancvs;
    }

    public function addAncv(Ancv $ancv): self
    {
        if (!$this->ancvs->contains($ancv)) {
            $this->ancvs[] = $ancv;
            $ancv->setUser($this);
        }

        return $this;
    }

    public function removeAncv(Ancv $ancv): self
    {
        if ($this->ancvs->contains($ancv)) {
            $this->ancvs->removeElement($ancv);
            // set the owning side to null (unless already changed)
            if ($ancv->getUser() === $this) {
                $ancv->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Noel[]
     */
    public function getNoels(): Collection
    {
        return $this->noels;
    }

    public function addNoel(Noel $noel): self
    {
        if (!$this->noels->contains($noel)) {
            $this->noels[] = $noel;
            $noel->setUser($this);
        }

        return $this;
    }

    public function removeNoel(Noel $noel): self
    {
        if ($this->noels->contains($noel)) {
            $this->noels->removeElement($noel);
            // set the owning side to null (unless already changed)
            if ($noel->getUser() === $this) {
                $noel->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participations[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participations $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setUser($this);
        }

        return $this;
    }

    public function removeParticipation(Participations $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Halloween[]
     */
    public function getHalloweens(): Collection
    {
        return $this->halloweens;
    }

    public function addHalloween(Halloween $halloween): self
    {
        if (!$this->halloweens->contains($halloween)) {
            $this->halloweens[] = $halloween;
            $halloween->setUser($this);
        }

        return $this;
    }

    public function removeHalloween(Halloween $halloween): self
    {
        if ($this->halloweens->contains($halloween)) {
            $this->halloweens->removeElement($halloween);
            // set the owning side to null (unless already changed)
            if ($halloween->getUser() === $this) {
                $halloween->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HalloweenCheck[]
     */
    public function getHalloweenChecks(): Collection
    {
        return $this->halloweenChecks;
    }

    public function addHalloweenCheck(HalloweenCheck $halloweenCheck): self
    {
        if (!$this->halloweenChecks->contains($halloweenCheck)) {
            $this->halloweenChecks[] = $halloweenCheck;
            $halloweenCheck->setUser($this);
        }

        return $this;
    }

    public function removeHalloweenCheck(HalloweenCheck $halloweenCheck): self
    {
        if ($this->halloweenChecks->contains($halloweenCheck)) {
            $this->halloweenChecks->removeElement($halloweenCheck);
            // set the owning side to null (unless already changed)
            if ($halloweenCheck->getUser() === $this) {
                $halloweenCheck->setUser(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(?\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

}
