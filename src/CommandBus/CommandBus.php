<?php

namespace App\CommandBus;

class CommandBus implements CommandBusMiddleware
{
    private $next;

    public function __construct(CommandBusMiddleware $next)
    {
        $this->next = $next;
    }
    public function dispatch(CommandInterface $command)
    {
        return $this->next->dispatch($command);
    }
}

