<?php

namespace App\CommandBus;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;

    public function listenTo(): string;
}
