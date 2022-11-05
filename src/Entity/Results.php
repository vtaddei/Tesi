<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $RaceTime = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubscribersRaces $Fk_SubscribersRaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceTime(): ?\DateTimeInterface
    {
        return $this->RaceTime;
    }

    public function setRaceTime(\DateTimeInterface $RaceTime): self
    {
        $this->RaceTime = $RaceTime;

        return $this;
    }

    public function getFkSubscribersRaces(): ?SubscribersRaces
    {
        return $this->Fk_SubscribersRaces;
    }

    public function setFkSubscribersRaces(SubscribersRaces $Fk_SubscribersRaces): self
    {
        $this->Fk_SubscribersRaces = $Fk_SubscribersRaces;

        return $this;
    }
}
