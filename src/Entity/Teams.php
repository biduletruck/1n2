<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=TeamsRepository::class)
 * @Vich\Uploadable()
 */
class Teams
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
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=Matches::class, mappedBy="Home")
     */
    private $HomeMatch;

    /**
     * @ORM\OneToMany(targetEntity=Matches::class, mappedBy="Visitor")
     */
    private $VisitorMatch;

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

    public function __construct()
    {
        $this->HomeMatch = new ArrayCollection();
        $this->VisitorMatch = new ArrayCollection();
        $this->updatedAt = new \DateTime();

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

    /**
     * @return Collection|Matches[]
     */
    public function getHomeMatch(): Collection
    {
        return $this->HomeMatch;
    }

    public function addHomeMatch(Matches $homeMatch): self
    {
        if (!$this->HomeMatch->contains($homeMatch)) {
            $this->HomeMatch[] = $homeMatch;
            $homeMatch->setHome($this);
        }

        return $this;
    }

    public function removeHomeMatch(Matches $homeMatch): self
    {
        if ($this->HomeMatch->contains($homeMatch)) {
            $this->HomeMatch->removeElement($homeMatch);
            // set the owning side to null (unless already changed)
            if ($homeMatch->getHome() === $this) {
                $homeMatch->setHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matches[]
     */
    public function getVisitorMatch(): Collection
    {
        return $this->VisitorMatch;
    }

    public function addVisitorMatch(Matches $visitorMatch): self
    {
        if (!$this->VisitorMatch->contains($visitorMatch)) {
            $this->VisitorMatch[] = $visitorMatch;
            $visitorMatch->setVisitor($this);
        }

        return $this;
    }

    public function removeVisitorMatch(Matches $visitorMatch): self
    {
        if ($this->VisitorMatch->contains($visitorMatch)) {
            $this->VisitorMatch->removeElement($visitorMatch);
            // set the owning side to null (unless already changed)
            if ($visitorMatch->getVisitor() === $this) {
                $visitorMatch->setVisitor(null);
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
     */
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
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
     */
    public function setThumbnailFile($thumbnailFile): void
    {
        $this->thumbnailFile = $thumbnailFile;

        if ($thumbnailFile){
            $this->updatedAt = new \DateTime();
        }
    }

    public function __toString()
    {
        return $this->Name;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
