<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\WishRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=WishRepository::class)
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Geo::class, inversedBy="wishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $geo;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="wishes")
     */
    private $type;

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
