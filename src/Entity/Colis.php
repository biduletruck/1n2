<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ColisRepository::class)
 * @Vich\Uploadable()
 */
class Colis
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
    private $nomColis;

    /**
     * @ORM\Column(type="text")
     */
    private $DescriptionColis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceColis;

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
     * @Vich\UploadableField(mapping="thumbnails ", fileNameProperty="thumbnails")
     */
    private $thumbnailFile;

    /**
     * @ORM\OneToMany(targetEntity=Noel::class, mappedBy="choixColis")
     */
    private $noels;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    public function __construct()
    {
        $this->noels = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomColis(): ?string
    {
        return $this->nomColis;
    }

    public function setNomColis(string $nomColis): self
    {
        $this->nomColis = $nomColis;

        return $this;
    }

    public function getDescriptionColis(): ?string
    {
        return $this->DescriptionColis;
    }

    public function setDescriptionColis(string $DescriptionColis): self
    {
        $this->DescriptionColis = $DescriptionColis;

        return $this;
    }

    public function getReferenceColis(): ?string
    {
        return $this->referenceColis;
    }

    public function setReferenceColis(string $referenceColis): self
    {
        $this->referenceColis = $referenceColis;

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
            $noel->setChoixColis($this);
        }

        return $this;
    }

    public function removeNoel(Noel $noel): self
    {
        if ($this->noels->contains($noel)) {
            $this->noels->removeElement($noel);
            // set the owning side to null (unless already changed)
            if ($noel->getChoixColis() === $this) {
                $noel->setChoixColis(null);
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
     * @return Colis
     */
    public function setThumbnail($thumbnail): Colis
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
     * @return Colis
     */
    public function setUpdatedAt($updatedAt): Colis
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
     * @return Colis
     */
    public function setThumbnailFile($thumbnailFile): Colis
    {
        $this->thumbnailFile = $thumbnailFile;
        return $this;
    }

    public function __toString()
    {
        return $this->nomColis;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }
}
