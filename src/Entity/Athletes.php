<?php

namespace App\Entity;

use App\Repository\AthletesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AthletesRepository::class)]
//#[ORM\Table(name: 'l_utenti')]
class Athletes implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column(nullable: true)]
    private ?int $TelephoneNumber = null;

    #[ORM\ManyToOne(targetEntity:PersonalData::class, cascade:["persist"] , inversedBy: 'athletes')]
    #[ORM\JoinColumn(nullable: false)]  #persist serve quando nessuna delle due entità esiste (in fase di creazione quibdi) e dice 'se salvo l'utente salvo anche l'altro a cascata
    private ?PersonalData $PersonalData = null;

//    #[ORM\ManyToOne] vecchio (orm)
//    #[ORM\JoinColumn(nullable: false)]
//    private ?PersonalData $Fk_PersonalData = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTelephoneNumber(): ?int
    {
        return $this->TelephoneNumber;
    }

    public function setTelephoneNumber(?int $TelephoneNumber): self
    {
        $this->TelephoneNumber = $TelephoneNumber;

        return $this;
    }

    public function getPersonalData(): ?PersonalData
    {
        return $this->PersonalData;
    }

    public function setPersonalData(?PersonalData $PersonalData): self
    {
        $this->PersonalData = $PersonalData;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(?Roles $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
