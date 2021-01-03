<?php

namespace App\Checker;

use App\Entity\Gift;
use App\Exception\GiftPriceBadlyFormattedException;
use App\Exception\UuidStringBadlyFormattedException;
use App\Specification\IsNumericValueSpecification;
use App\Specification\ValidUuidStringSpecification;

class GiftChecker
{
    private $validUuidStringSpecification;
    private $isNumericValueSpecification;

    public function __construct(
        ValidUuidStringSpecification $validUuidStringSpecification,
        IsNumericValueSpecification $isNumericValueSpecification
    ) {
        $this->validUuidStringSpecification = $validUuidStringSpecification;
        $this->isNumericValueSpecification = $isNumericValueSpecification;
    }

    public function check(Gift $gift): void
    {
        if (false === $this->validUuidStringSpecification->isSatisfiedBy($gift->getUuid())) {
            throw new UuidStringBadlyFormattedException($gift->getUuid());
        }

        if (false === $this->isNumericValueSpecification->isSatisfiedBy($gift->getPrice())) {
            throw new GiftPriceBadlyFormattedException($gift->getPrice());
        }
    }
}
