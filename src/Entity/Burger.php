<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    #[ORM\ManyToOne(inversedBy: 'burgers')]
    private ?Frie $frie = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duration = null;

    #[ORM\Column(nullable: true)]
    private ?int $durationS = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getFrie(): ?Frie
    {
        return $this->frie;
    }

    public function setFrie(?Frie $frie): self
    {
        $this->frie = $frie;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(?\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDurationS(): ?int
    {
        return $this->durationS;
    }

    public function setDurationS(?int $durationS): self
    {
        $this->durationS = $durationS;

        return $this;
    }

    public function __toString(): string
    {
       return $this->getFrie();
    }


}