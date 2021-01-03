<?php

namespace App\CommandBus\CommandHandler;

use App\CommandBus\Command\ImportGiftStockCommand;
use App\CommandBus\CommandHandlerInterface;
use App\CommandBus\CommandInterface;
use App\Exception\NoFileUploadedException;
use App\Parser\GiftStockParser;

class ImportGiftStockCommandHandler implements CommandHandlerInterface
{
    private $parser;

    public function __construct(GiftStockParser $parser)
    {
        $this->parser = $parser;
    }

    public function handle(CommandInterface $command): void
    {
        if (null === $command->file) {
            throw new NoFileUploadedException();
        }

        $this->parser->parse($command->file->getRealPath());
    }

    public function listenTo(): string
    {
        return ImportGiftStockCommand::class;
    }
}
