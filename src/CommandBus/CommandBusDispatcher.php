<?php

namespace App\CommandBus;

class CommandBusDispatcher implements CommandBusMiddleware
{
    private $handlers;

    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(CommandInterface $command)
    {
        $commandClass = get_class($command);
        $handler = $this->handlers[$commandClass];

        if (null === $handler) {
            throw new \LogicException('Handler for class: ' . $commandClass . ' does not exist.');
        }

        return $handler->handle($command);
    }
}
