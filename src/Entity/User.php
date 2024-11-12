<?php

namespace App\Entity;

use App\Doctrine\Type\ContractTypeEnumType;
use App\Doctrine\Type\RoleEnumType;
use App\Enum\ContractTypeEnum;
use App\Enum\RoleEnum;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(type: RoleEnumType::ROLE_ENUM)]
    private ?RoleEnum $role = null;


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
     * @var Collection<int, Project>|null
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users', cascade: ['persist'])]
    private ?Collection $projects = null;

    private ?bool $active = null;

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

    public function getRole(): ?RoleEnum
    {
        return $this->role;
    }

    public function setRole(RoleEnum $role): static
    {
        $this->role = $role;

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

    public function addProject(Project $project): static
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

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
    public function getRoles(): array {}
    public function eraseCredentials(): void {}

}
