<?php

namespace App\Enum;

enum ContractTypeEnum
{
    case CDI;
    case CDD;

    public static function from(string $value): self
    {
        return match ($value) {
            'CDI' => self::CDI,
            'CDD' => self::CDD,
            default => throw new \InvalidArgumentException("Invalid contract type value: $value"),
        };
    }
}
