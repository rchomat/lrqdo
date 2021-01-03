<?php

namespace App\QueryBus;

interface QueryHandlerInterface
{
    public function handle(QueryInterface $command);

    public function listenTo(): string;
}
