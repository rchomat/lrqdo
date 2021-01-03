<?php

namespace App\Specification;

interface SpecificationInterface
{
    public function isSatisfiedBy($value): bool;
}
