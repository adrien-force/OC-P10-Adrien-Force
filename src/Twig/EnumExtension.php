<?php
namespace App\Twig;

use App\Enum\ContractTypeEnum;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EnumExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('enum_to_string', [$this, 'enumToString']),
        ];
    }

    public function enumToString(ContractTypeEnum $enum): string
    {
        return $enum->name;
    }
}