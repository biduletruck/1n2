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
    private $conjoint = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreEnfants = 0;


    /**
     * @ORM\Column(type="boolean")
     */
    private $present = 0;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reglement = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $roller = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $foot = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tennis = 0;



    public function __construct()
    {

        $this->CreatedAt = new \Datetime();
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



    public function getPresent(): ?bool
    {
        return $this->present;
    }

    public function setPresent(bool $present): self
    {
        $this->present = $present;

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

    public function getReglement(): ?bool
    {
        return $this->reglement;
    }

    public function setReglement(bool $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getRoller(): ?bool
    {
        return $this->roller;
    }

    public function setRoller(bool $roller): self
    {
        $this->roller = $roller;

        return $this;
    }

    public function getFoot(): ?bool
    {
        return $this->foot;
    }

    public function setFoot(bool $foot): self
    {
        $this->foot = $foot;

        return $this;
    }

    public function getTennis(): ?bool
    {
        return $this->tennis;
    }

    public function setTennis(bool $tennis): self
    {
        $this->tennis = $tennis;

        return $this;
    }


}
