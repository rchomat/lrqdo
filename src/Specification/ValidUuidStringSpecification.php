<?php

namespace App\Specification;

use Ramsey\Uuid\Uuid;

class ValidUuidStringSpecification implements SpecificationInterface
{
    public function isSatisfiedBy($value): bool
    {
        return Uuid::isValid($value);
    }
}
