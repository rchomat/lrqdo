<?php

namespace App\Controller;

use App\QueryBus\Query\StatisticsQuery;
use App\QueryBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats", name="stats", methods={"GET"})
     */
    public function import(QueryBus $queryBus): Response
    {
        $stats = $queryBus->dispatch(new StatisticsQuery());

        return $this->json($stats);
    }
}
