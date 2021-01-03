<?php

namespace App\Exception;

class FileBadlyFormattedException extends BaseException
{
    public function __construct(float $line, \Throwable $previous = null)
    {
        parent::__construct(sprintf('File badly formatted around line %d', $line), 400, $previous);
    }
}
