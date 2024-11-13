<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RoleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('translate_role', [$this, 'translateRole']),
        ];
    }

    public function translateRole(string $role): string
    {
        return match ($role) {
            'ROLE_ADMIN' => 'Admin',
            'ROLE_USER' => 'Collaborateur',
            default => $role,
        };
    }
}