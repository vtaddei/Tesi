<?php

namespace App\Entity;

use App\Repository\PersonalDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PersonalDataRepository::class)]
class PersonalData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $Birthplace = null;

    #[ORM\Column(length: 255)]
    private ?string $Gender = null;

    #[ORM\Column(length: 255)]
    private ?string $TaxCode = null;

    #[ORM\Column]
    private ?int $DisadvantageFlag = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MedicalCertificate $Fk_MedicalCertificate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EntryFee $Fk_EntryFee = null;

    #[ORM\OneToMany(mappedBy: 'PersonalData', targetEntity: Athletes::class, cascade:["persist"], orphanRemoval: true)]
    private ?ArrayCollection $athletes; // Da cambiare in Collection

    public function __construct()
    {
        $this->athletes = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->Birthdate;
    }

    public function setBirthdate(\DateTimeInterface $Birthdate): self
    {
        $this->Birthdate = $Birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->Birthplace;
    }

    public function setBirthplace(string $Birthplace): self
    {
        $this->Birthplace = $Birthplace;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getTaxCode(): ?string
    {
        return $this->TaxCode;
    }

    public function setTaxCode(string $TaxCode): self
    {
        $this->TaxCode = $TaxCode;

        return $this;
    }

    public function getDisadvantageFlag(): ?int
    {
        return $this->DisadvantageFlag;
    }

    public function setDisadvantageFlag(int $DisadvantageFlag): self
    {
        $this->DisadvantageFlag = $DisadvantageFlag;

        return $this;
    }

    public function getFkMedicalCertificate(): ?MedicalCertificate
    {
        return $this->Fk_MedicalCertificate;
    }

    public function setFkMedicalCertificate(?MedicalCertificate $Fk_MedicalCertificate): self
    {
        $this->Fk_MedicalCertificate = $Fk_MedicalCertificate;

        return $this;
    }

    public function getFkEntryFee(): ?EntryFee
    {
        return $this->Fk_EntryFee;
    }

    public function setFkEntryFee(?EntryFee $Fk_EntryFee): self
    {
        $this->Fk_EntryFee = $Fk_EntryFee;

        return $this;
    }

    /**
     * @return Collection<int, Athletes>
     */
    public function getAthletes(): Collection
    {
        return $this->athletes;
    }

    public function addAthletes(Athletes $athletes): self
    {
        if (!$this->athletes->contains($athletes)) {
            $this->athletes[] = $athletes;
            $athletes->setPersonalData($this);
        }

        return $this;
    }

    public function removeAthletes(Athletes $athletes): self
    {
        if ($this->athletes->removeElement($athletes)) {
            // set the owning side to null (unless already changed)
            if ($athletes->getPersonalData() === $this) {
                $athletes->setPersonalData(null);
            }
        }

        return $this;
    }




}
