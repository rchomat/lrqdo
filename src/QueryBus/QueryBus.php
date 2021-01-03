<?php

namespace App\QueryBus;

class QueryBus implements QueryBusMiddleware
{
    private $next;

    public function __construct(QueryBusMiddleware $next)
    {
        $this->next = $next;
    }
    public function dispatch(QueryInterface $command)
    {
        return $this->next->dispatch($command);
    }
}

