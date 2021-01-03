<?php

namespace App\Specification;

class IsNumericValueSpecification implements SpecificationInterface
{
    public function isSatisfiedBy($value): bool
    {
        return preg_match("/^[0-9]+([.][0-9]{1,6})?$/", $value);
    }
}
