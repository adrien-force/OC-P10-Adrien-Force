<?php

namespace App\Security\Voter;

use App\Entity\Project;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectVoter extends Voter
{

    const VIEW = 'view';
    const EDIT = 'edit';
    const ADD = 'add';

    public function __construct(private readonly Security $security){}

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::ADD])) {
            return false;
        }

        if ($subject !== null && !$subject instanceof Project) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        $project = $subject;

        return match ($attribute) {
            self::VIEW =>  $this->canView($project, $user),
            self::EDIT, self::ADD =>  $this->canEditOrAdd($project),
            default => Throw new \LogicException('Voter has reached a non existing attribute, this should not happen'),
        };
    }

    private function canView(mixed $project, User $user): bool
    {
        if ($this->canEditOrAdd($project)) {
            return true;
        }

        return in_array($user, $project->getUsers()->toArray());
    }

    private function canEditOrAdd($project): bool
    {
        return $this->security->isGranted('ROLE_ADMIN');
    }
}