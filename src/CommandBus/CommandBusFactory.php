<?php

namespace App\CommandBus;

class CommandBusFactory
{
    public static function build(iterable $handler): CommandBusMiddleware
    {
        return new CommandBus(new CommandBusDispatcher($handler));
    }

}

