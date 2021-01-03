<?php

namespace App\Exception;

class ImportGiftStockFileInvalidColumnNameException extends BaseException
{
    public function __construct(array $expected, array $got, \Throwable $previous = null)
    {
        $message = sprintf('Column names does not match. Expected: "%s", got: "%s"', implode(', ', $expected), implode(', ', $got));

        parent::__construct($message, 400, $previous);
    }
}
