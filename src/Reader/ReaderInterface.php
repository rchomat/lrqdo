<?php

namespace App\Reader;

interface ReaderInterface
{
    public function load(string $filePath, string $delimiter = ',', string $fieldEnclosure = '"', string $escapeChar = '\\'): self;

    public function getColumnNames(): array;

    public function useFirstRowAsHeader(): self;

    public function support(string $type);
}
