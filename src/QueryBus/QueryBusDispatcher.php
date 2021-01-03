<?php

namespace App\QueryBus;

class QueryBusDispatcher implements QueryBusMiddleware
{
    private $handlers;

    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(QueryInterface $command)
    {
        $queryClass = get_class($command);
        $handler = $this->handlers[$queryClass];

        if (null === $handler) {
            throw new \LogicException('Handler for class: ' . $queryClass . ' does not exist.');
        }

        return $handler->handle($command);
    }
}
