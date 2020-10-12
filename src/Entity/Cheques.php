<?php

namespace App\Entity;

use App\Repository\ChequesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ChequesRepository::class)
 * @Vich\Uploadable()
 */
class Cheques
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCheque;

    /**
     * @ORM\OneToMany(targetEntity=Noel::class, mappedBy="choixCheque")
     */
    private $noels;

    /**
     * @ORM\Column(type="string", length=100)
     *
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail")
     */
    private $thumbnailFile;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Lien;

    public function __construct()
    {
        $this->noels = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCheque(): ?string
    {
        return $this->nomCheque;
    }

    public function setNomCheque(string $nomCheque): self
    {
        $this->nomCheque = $nomCheque;

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
            $noel->setChoixCheque($this);
        }

        return $this;
    }

    public function removeNoel(Noel $noel): self
    {
        if ($this->noels->contains($noel)) {
            $this->noels->removeElement($noel);
            // set the owning side to null (unless already changed)
            if ($noel->getChoixCheque() === $this) {
                $noel->setChoixCheque(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     * @return Cheques
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return Cheques
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }

    /**
     * @param mixed $thumbnailFile
     * @return Cheques
     */
    public function setThumbnailFile($thumbnailFile)
    {
        $this->thumbnailFile = $thumbnailFile;
        return $this;
    }

    public function __toString()
    {
        return $this->nomCheque;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->Lien;
    }

    public function setLien(?string $Lien): self
    {
        $this->Lien = $Lien;

        return $this;
    }
}
