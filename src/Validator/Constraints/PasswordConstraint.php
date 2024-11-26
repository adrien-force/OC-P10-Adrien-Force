<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordConstraint extends Constraint
{
    public string $message = 'Le mot de passe doit contenir au moins 6 caractères, un caractère spécial et une lettre majuscule.';
}