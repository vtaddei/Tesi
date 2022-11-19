<?php

namespace App\Entity;

use App\Repository\RacesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RacesRepository::class)]
class Races
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(nullable: true)]
    private ?int $Capacity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column]
    private ?int $RaceType = null;

    #[ORM\Column]
    private ?int $FlagDisadvantage = null;

    #[ORM\Column(length: 255)]
    private ?string $length = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $real_length = null;

    #[ORM\Column]
    private ?bool $social_race = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Price = null;

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

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(?int $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getRaceType(): ?int
    {
        return $this->RaceType;
    }

    public function setRaceType(int $RaceType): self
    {
        $this->RaceType = $RaceType;

        return $this;
    }

    public function getFlagDisadvantage(): ?int
    {
        return $this->FlagDisadvantage;
    }

    public function setFlagDisadvantage(int $FlagDisadvantage): self
    {
        $this->FlagDisadvantage = $FlagDisadvantage;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getRealLength(): ?string
    {
        return $this->real_length;
    }

    public function setRealLength(?string $real_length): self
    {
        $this->real_length = $real_length;

        return $this;
    }

    public function isSocialRace(): ?bool
    {
        return $this->social_race;
    }

    public function setSocialRace(bool $social_race): self
    {
        $this->social_race = $social_race;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(?string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
