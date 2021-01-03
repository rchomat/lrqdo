<?php

namespace App\Repository;

use App\Entity\Gift;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GiftRepository extends ServiceEntityRepository implements GiftRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gift::class);
    }

    public function findOneById($id): ?Gift
    {
        return $this->find($id);
    }

    public function findOneByUuid($uuid): ?Gift
    {
        return $this->findOneBy(['uuid' => $uuid]);
    }

    public function getStats(): array
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('COUNT(g.id) AS nb_gifts, MIN(g.price) AS min_price, MAX(g.price) AS max_price, AVG(g.price) AS avg_price');

        return $qb->getQuery()->getSingleResult();
    }

    public function persist(Gift $gift): void
    {
        $this->getEntityManager()->persist($gift);
    }
}
