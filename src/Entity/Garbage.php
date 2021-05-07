<?php

namespace App\Entity;

use App\Entity\Geo;
use App\Entity\Type;
use App\Entity\Report;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GarbageRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"garbage_read"}},
 * )
 * @ORM\Entity(repositoryClass=GarbageRepository::class)
 * 
 * 
 */
class Garbage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"garbage_read"})
     */
    private $id;


    /**
     * 
     * @Groups({"garbage_read"})
     * @ORM\ManyToOne(targetEntity=Geo::class, inversedBy="garbages")
     */
    private $geo;

    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * 
     * @ORM\OneToMany(targetEntity=Report::class, mappedBy="garbage")
     */
    private $reports;

    /**
     * @Groups({"garbage_read"})
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="garbages")
     */
    private $type;


    public function __construct()
    {
        $this->reports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeo(): ?Geo
    {
        return $this->geo;
    }

    public function setGeo(?Geo $geo): self
    {
        $this->geo = $geo;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setGarbage($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getGarbage() === $this) {
                $report->setGarbage(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }


}
