<?php

namespace App\Repository;

use App\Entity\Receiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReceiverRepository extends ServiceEntityRepository implements ReceiverRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Receiver::class);
    }

    public function findOneById($id): ?Receiver
    {
        return $this->find($id);
    }

    public function findOneByUuid($uuid): ?Receiver
    {
        return $this->findOneBy(['uuid' => $uuid]);
    }

    public function getNbCountries(): array
    {
        $qb = $this->createQueryBuilder('r');
        $qb->SELECT('COUNT(DISTINCT r.countryCode) AS nb_countries');

        return $qb->getQuery()->getSingleResult();
    }

    public function persist(Receiver $receiver): void
    {
        $this->getEntityManager()->persist($receiver);
    }
}
