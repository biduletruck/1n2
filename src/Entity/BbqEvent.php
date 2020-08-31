<?php

namespace App\Entity;

use App\Repository\BbqEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BbqEventRepository::class)
 */
class BbqEvent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="bbqEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salarie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conjoint;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreEnfants;

    /**
     * @ORM\ManyToOne(targetEntity=Bbq::class, inversedBy="bbqEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $newBbq;

    /**
     * @ORM\Column(type="boolean")
     */
    private $present;




    public function __construct()
    {
        $this->bbqEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getConjoint(): ?bool
    {
        return $this->conjoint;
    }

    public function setConjoint(bool $conjoint): self
    {
        $this->conjoint = $conjoint;

        return $this;
    }

    public function getNombreEnfants(): ?int
    {
        return $this->nombreEnfants;
    }

    public function setNombreEnfants(?int $nombreEnfants): self
    {
        $this->nombreEnfants = $nombreEnfants;

        return $this;
    }

    public function getNewBbq(): ?self
    {
        return $this->newBbq;
    }



    public function addBbqEvent(self $bbqEvent): self
    {
        if (!$this->bbqEvents->contains($bbqEvent)) {
            $this->bbqEvents[] = $bbqEvent;
            $bbqEvent->setNewBbq($this);
        }

        return $this;
    }

    public function removeBbqEvent(self $bbqEvent): self
    {
        if ($this->bbqEvents->contains($bbqEvent)) {
            $this->bbqEvents->removeElement($bbqEvent);
            // set the owning side to null (unless already changed)
            if ($bbqEvent->getNewBbq() === $this) {
                $bbqEvent->setNewBbq(null);
            }
        }

        return $this;
    }

    public function getPresent(): ?bool
    {
        return $this->present;
    }

    public function setPresent(bool $present): self
    {
        $this->present = $present;

        return $this;
    }


}
