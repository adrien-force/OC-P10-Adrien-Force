<?php

namespace App\Doctrine\Type;

use App\Enum\ContractTypeEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class ContractTypeEnumType extends Type
{
    const CONTRACT_TYPE_ENUM = 'contract_type_enum';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "VARCHAR(255)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? ContractTypeEnum::from($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof ContractTypeEnum ? $value->name : null;
    }

    public function getName()
    {
        return self::CONTRACT_TYPE_ENUM;
    }
}