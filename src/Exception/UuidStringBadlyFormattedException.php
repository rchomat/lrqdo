<?php

namespace App\Exception;

class UuidStringBadlyFormattedException extends BaseException
{
    public function __construct(string $uuid, \Throwable $previous = null)
    {
        parent::__construct(sprintf('Uuid string "%s" is badly formatted', $uuid), 400, $previous);
    }
}
