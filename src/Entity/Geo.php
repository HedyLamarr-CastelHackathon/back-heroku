<?php

namespace App\Entity;

use App\Repository\GeoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GeoRepository::class)
 */
class Geo
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
    private $localisation;

    /**
     * @ORM\OneToMany(targetEntity=Garbage::class, mappedBy="geo")
     */
    private $garbages;

    /**
     * @ORM\OneToMany(targetEntity=Wish::class, mappedBy="geo")
     */
    private $wishes;

    public function __construct()
    {
        $this->garbages = new ArrayCollection();
        $this->wishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection|Garbage[]
     */
    public function getGarbages(): Collection
    {
        return $this->garbages;
    }

    public function addGarbage(Garbage $garbage): self
    {
        if (!$this->garbages->contains($garbage)) {
            $this->garbages[] = $garbage;
            $garbage->setGeo($this);
        }

        return $this;
    }

    public function removeGarbage(Garbage $garbage): self
    {
        if ($this->garbages->removeElement($garbage)) {
            // set the owning side to null (unless already changed)
            if ($garbage->getGeo() === $this) {
                $garbage->setGeo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wish[]
     */
    public function getWishes(): Collection
    {
        return $this->wishes;
    }

    public function addWish(Wish $wish): self
    {
        if (!$this->wishes->contains($wish)) {
            $this->wishes[] = $wish;
            $wish->setGeo($this);
        }

        return $this;
    }

    public function removeWish(Wish $wish): self
    {
        if ($this->wishes->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getGeo() === $this) {
                $wish->setGeo(null);
            }
        }

        return $this;
    }
}
