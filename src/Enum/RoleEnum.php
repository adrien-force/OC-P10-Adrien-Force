<?php

namespace App\Enum;

enum RoleEnum
{
    case ADMIN;
    case MANAGER;
    case COLLABORATOR;

    public static function from(string $value): self
    {
        return match ($value) {
            'ADMIN' => self::ADMIN,
            'MANAGER' => self::MANAGER,
            'COLLABORATOR' => self::COLLABORATOR,
            default => throw new \InvalidArgumentException("Invalid role value: $value"),
        };
    }
}
