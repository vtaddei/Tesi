<?php

namespace App\Entity;

use App\Repository\SubscribersRacesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscribersRacesRepository::class)]
class SubscribersRaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Team = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $RegistrationDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Athletes $Fk_Athletes = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Races $Fk_Races = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?int
    {
        return $this->Team;
    }

    public function setTeam(?int $Team): self
    {
        $this->Team = $Team;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->RegistrationDate;
    }

    public function setRegistrationDate(?\DateTimeInterface $RegistrationDate): self
    {
        $this->RegistrationDate = $RegistrationDate;

        return $this;
    }

    public function getFkAthletes(): ?Athletes
    {
        return $this->Fk_Athletes;
    }

    public function setFkAthletes(?Athletes $Fk_Athletes): self
    {
        $this->Fk_Athletes = $Fk_Athletes;

        return $this;
    }

    public function getFkRaces(): ?Races
    {
        return $this->Fk_Races;
    }

    public function setFkRaces(?Races $Fk_Races): self
    {
        $this->Fk_Races = $Fk_Races;

        return $this;
    }
}
