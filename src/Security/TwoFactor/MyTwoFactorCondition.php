<?php

namespace App\Security\TwoFactor;

use App\Entity\User;
use Scheb\TwoFactorBundle\Security\TwoFactor\AuthenticationContextInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Condition\TwoFactorConditionInterface;
use Symfony\Bundle\SecurityBundle\Security;

class MyTwoFactorCondition implements TwoFactorConditionInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function shouldPerformTwoFactorAuthentication(AuthenticationContextInterface $context): bool
    {
        /* @var $user User */
        $user = $this->security->getUser();

        if (!$user) {
            return false;
        }

        return $user->isUseTwoFactorAuth();
    }
}