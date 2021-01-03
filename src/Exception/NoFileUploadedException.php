<?php

namespace App\Exception;

class NoFileUploadedException extends BaseException
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct('No file uploaded', 400, $previous);
    }
}
