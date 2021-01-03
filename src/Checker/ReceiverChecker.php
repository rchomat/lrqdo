<?php

namespace App\Checker;

use App\Entity\Receiver;
use App\Exception\UuidStringBadlyFormattedException;
use App\Specification\ValidUuidStringSpecification;

class ReceiverChecker
{
    private $validUuidStringSpecification;

    public function __construct(ValidUuidStringSpecification $validUuidStringSpecification)
    {
        $this->validUuidStringSpecification = $validUuidStringSpecification;
    }

    public function check(Receiver $receiver): void
    {
        if (false === $this->validUuidStringSpecification->isSatisfiedBy($receiver->getUuid())) {
            throw new UuidStringBadlyFormattedException($receiver->getUuid());
        }
    }
}
