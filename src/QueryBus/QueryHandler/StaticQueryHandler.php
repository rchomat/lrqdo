<?php

namespace App\QueryBus\QueryHandler;

use App\QueryBus\Query\StatisticsQuery;
use App\QueryBus\QueryHandlerInterface;
use App\QueryBus\QueryInterface;
use App\Repository\GiftRepositoryInterface;
use App\Repository\ReceiverRepositoryInterface;

class StaticQueryHandler implements QueryHandlerInterface
{
    private GiftRepositoryInterface $giftRepository;
    private ReceiverRepositoryInterface $receiverRepository;

    public function __construct(GiftRepositoryInterface $giftRepository, ReceiverRepositoryInterface $receiverRepository)
    {
        $this->giftRepository = $giftRepository;
        $this->receiverRepository = $receiverRepository;
    }

    public function handle(QueryInterface $query)
    {
        $stats = array_merge_recursive($this->giftRepository->getStats(), $this->receiverRepository->getNbCountries());
        $stats['avg_price'] = (string)round($stats['avg_price'], 2);

        return $stats;
    }

    public function listenTo(): string
    {
        return StatisticsQuery::class;
    }
}
