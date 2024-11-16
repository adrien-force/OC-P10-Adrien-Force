<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    public function __construct(private readonly Security $security){}

    const EDIT = 'edit';
    const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::VIEW])) {
            return false;
        }

        if ($subject !== null && !$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return match ($attribute) {
            self::EDIT => $this->canEdit(),
            self::VIEW => $this->canView(),
            default => Throw new \LogicException('Voter has reached a non existing attribute, this should not happen'),
        };
    }

    private function canView(): true
    {
        return true;
    }

    private function canEdit(): bool
    {
        return $this->security->isGranted('ROLE_ADMIN');
    }

}