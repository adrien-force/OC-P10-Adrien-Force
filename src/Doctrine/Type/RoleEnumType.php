<?php

namespace App\Doctrine\Type;

use App\Enum\RoleEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class RoleEnumType extends Type
{
    const ROLE_ENUM = 'role_enum';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "VARCHAR(255)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? RoleEnum::from($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof RoleEnum ? $value->name : null;
    }

    public function getName()
    {
        return self::ROLE_ENUM;
    }
}