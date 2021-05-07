<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\WishRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"wish_read"}},
 *  denormalizationContext={"groups"={"wish_write"}}
 * )
 * @ORM\Entity(repositoryClass=WishRepository::class)
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wish_read","wish_write"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Geo::class, inversedBy="wishes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wish_read","wish_write"})
     */
    private $geo;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="wishes")
     * @Groups({"wish_read","wish_write"})
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
