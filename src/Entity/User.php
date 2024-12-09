<?php

namespace App\Entity;

use App\Doctrine\Type\ContractTypeEnumType;
use App\Enum\ContractTypeEnum;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Service\TranslatorHelper;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $roles = [];

    #[ORM\Column(type: ContractTypeEnumType::CONTRACT_TYPE_ENUM, nullable: true)]
    private ?ContractTypeEnum $contractType = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $arrivalAt = null;


    /**
     * @var Collection<int, Task>|null
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'user')]
    private ?Collection $tasks = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $projects;


    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $active = true;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $authCode;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool $useTwoFactorAuth = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }


    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getContractType(): ?ContractTypeEnum
    {
        return $this->contractType;
    }

    public function setContractType(ContractTypeEnum $contractType): static
    {
        $this->contractType = $contractType;

        return $this;
    }

    public function getArrivalAt(): ?DateTimeInterface
    {
        return $this->arrivalAt;
    }

    public function setArrivalAt(DateTimeInterface $arrivalAt): static
    {
        $this->arrivalAt = $arrivalAt;

        return $this;
    }

    public function getTasks(): ?Collection
    {
        return $this->tasks;
    }

    public function setTasks(Collection $tasks): static
    {
        $this->tasks = $tasks;

        return $this;
    }

    public function getProjects(): ?Collection
    {
        return $this->projects;
    }

    public function addProject(?Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addUser($this);
        }

        return $this;
    }

    public function setProjects(Collection $projects): static
    {
        $this->projects = $projects;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getFullname(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getInitials(): string
    {
        return strtoupper($this->firstname[0] . $this->lastname[0]);
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
    public function eraseCredentials(): void {}

    public function getRoles(): array {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function getRoleLabel(): string {
        return match($this->getRoles()[0]) {
            'ROLE_ADMIN' => 'Admin',
            'ROLE_USER' => 'Collaborateur',
        };
    }

    public function setRoles(?array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    public function addRole(?string $role): User
    {
        $this->roles[] = $role;
        return $this;
    }

    public function isEmailAuthEnabled(): bool
    {
        return true;
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }

    public function getEmailAuthCode(): string|null
    {
        if (null === $this->authCode) {
            throw new \LogicException('The email authentication code was not set');
        }

        return $this->authCode;    }

    public function setEmailAuthCode(string $authCode): void
    {
        $this->authCode = $authCode;
    }

    public function isUseTwoFactorAuth(): bool
    {
        return $this->useTwoFactorAuth;
    }

    public function setUseTwoFactorAuth(bool $useTwoFactorAuth): User
    {
        $this->useTwoFactorAuth = $useTwoFactorAuth;
        return $this;
    }
}
