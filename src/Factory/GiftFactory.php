<?php

namespace App\Factory;

use App\Entity\Gift;

class GiftFactory
{
    public static function create(string $id, string $code, string $description, $price): Gift
    {
        return new Gift($id, $code, $description, $price);
    }
}
