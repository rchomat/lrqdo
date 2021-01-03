<?php

namespace App\Repository;

use App\Entity\Receiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

interface ReceiverRepositoryInterface
{
    public function findOneById($id): ?Receiver;
    public function findOneByUuid($uuid): ?Receiver;
    public function persist(Receiver $receiver): void;
}
