<?php

namespace App\Exception;

abstract class BaseException extends \Exception //implements QuitoqueExceptionInterface
{
    protected $errorKey;

    public function __construct($message, int $code, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $className      = explode('\\', static::class);
        $this->errorKey = end($className);
        $this->errorKey = substr($this->errorKey, 0, strlen($this->errorKey) - 9);
    }

    /**
     * @return false|string[]
     */
    public function getErrorKey(): ?string
    {
        return $this->errorKey;
    }

}
