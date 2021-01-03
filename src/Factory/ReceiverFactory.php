<?php

namespace App\Factory;

use App\Entity\Receiver;

class ReceiverFactory
{
    public static function create(string $id, string $firstName, string $lastName, string $countryCode): Receiver
    {
        return new Receiver($id, $firstName, $lastName, $countryCode);
    }
}
