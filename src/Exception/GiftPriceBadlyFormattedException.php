<?php

namespace App\Exception;

class GiftPriceBadlyFormattedException extends BaseException
{
    public function __construct($price, \Throwable $previous = null)
    {
        parent::__construct(sprintf('Price "%s" is badly formatted', $price), 400, $previous);
    }
}
