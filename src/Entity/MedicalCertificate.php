<?php

namespace App\Entity;

use App\Repository\MedicalCertificateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalCertificateRepository::class)]
class MedicalCertificate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DeliveryDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ExpirationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $Typology = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->DeliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $DeliveryDate): self
    {
        $this->DeliveryDate = $DeliveryDate;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $ExpirationDate): self
    {
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }

    public function getTypology(): ?string
    {
        return $this->Typology;
    }

    public function setTypology(string $Typology): self
    {
        $this->Typology = $Typology;

        return $this;
    }
}
