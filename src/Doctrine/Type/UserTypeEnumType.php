<?php

namespace App\Doctrine\Type;

use App\Enum\UserTypeEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class UserTypeEnumType extends Type
{
    const USER_TYPE_ENUM = 'user_type_enum';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "VARCHAR(255)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? UserTypeEnum::from($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof UserTypeEnum ? $value->name : null;
    }

    public function getName()
    {
        return self::USER_TYPE_ENUM;
    }
}