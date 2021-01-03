<?php

namespace App\QueryBus;

class QueryBusFactory
{
    public static function build(iterable $handler): QueryBusMiddleware
    {
        return new QueryBus(new QueryBusDispatcher($handler));
    }

}

