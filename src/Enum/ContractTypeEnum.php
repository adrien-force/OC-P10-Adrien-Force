<?php

namespace App\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum ContractTypeEnum implements TranslatableInterface
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

    public function trans(TranslatorInterface $translator, ?string $locale = null): string
    {
        return match ($this) {
            self::CDI => $translator->trans('enum.contractType.CDI', [], null, $locale),
            self::CDD => $translator->trans('enum.contractType.CDD', [], null, $locale),
        };
    }
}
