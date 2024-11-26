<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PasswordConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PasswordConstraint) {
            throw new UnexpectedTypeException($constraint, PasswordConstraint::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*\W).{6,}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}