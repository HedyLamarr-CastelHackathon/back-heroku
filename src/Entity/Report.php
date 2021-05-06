<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReportRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 * 
 */
class Report
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Garbage::class, inversedBy="reports")
     */
    private $garbage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFull;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDamaged;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isHere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarbage(): ?Garbage
    {
        return $this->garbage;
    }

    public function setGarbage(?Garbage $garbage): self
    {
        $this->garbage = $garbage;

        return $this;
    }

    public function getIsFull(): ?bool
    {
        return $this->isFull;
    }

    public function setIsFull(?bool $isFull): self
    {
        $this->isFull = $isFull;

        return $this;
    }

    public function getIsDamaged(): ?bool
    {
        return $this->isDamaged;
    }

    public function setIsDamaged(?bool $isDamaged): self
    {
        $this->isDamaged = $isDamaged;

        return $this;
    }

    public function getIsHere(): ?bool
    {
        return $this->isHere;
    }

    public function setIsHere(?bool $isHere): self
    {
        $this->isHere = $isHere;

        return $this;
    }
  


}
