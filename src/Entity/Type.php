<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Garbage::class, mappedBy="type")
     */
    private $garbages;

    /**
     * @ORM\OneToMany(targetEntity=Wish::class, mappedBy="type")
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
            $garbage->setType($this);
        }

        return $this;
    }

    public function removeGarbage(Garbage $garbage): self
    {
        if ($this->garbages->removeElement($garbage)) {
            // set the owning side to null (unless already changed)
            if ($garbage->getType() === $this) {
                $garbage->setType(null);
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
            $wish->setType($this);
        }

        return $this;
    }

    public function removeWish(Wish $wish): self
    {
        if ($this->wishes->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getType() === $this) {
                $wish->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->code;
    }

}
