<?php

namespace App\Controller;

use App\CommandBus\Command\ImportGiftStockCommand;
use App\CommandBus\CommandBus;
use App\QueryBus\Query\StatisticsQuery;
use App\QueryBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImportGiftStockController extends AbstractController
{
    /**
     * @Route("/import/gift-stock", name="import_gift_stock", methods={"POST"})
     */
    public function import(Request $request, CommandBus $commandBus, QueryBus $queryBus): Response
    {
        $importCommand = new ImportGiftStockCommand($request->files->get('file'));
        $commandBus->dispatch($importCommand);

        $stats = $queryBus->dispatch(new StatisticsQuery());

        return $this->json($stats);
    }
}
