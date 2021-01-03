<?php

namespace App\Repository;

use App\Entity\Gift;

interface GiftRepositoryInterface
{
    public function findOneById($id): ?Gift;
    public function findOneByUuid($uuid): ?Gift;
    public function getStats(): array;
    public function persist(Gift $gift): void;
}
