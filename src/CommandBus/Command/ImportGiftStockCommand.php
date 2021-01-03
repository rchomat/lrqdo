<?php

namespace App\CommandBus\Command;

use App\CommandBus\CommandInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImportGiftStockCommand implements CommandInterface
{
    public $file;

    public function __construct(?UploadedFile $file)
    {
        $this->file = $file;
    }
}
