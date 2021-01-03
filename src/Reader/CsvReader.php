<?php

namespace App\Reader;

use App\Exception\FileBadlyFormattedException;

class CsvReader implements ReaderInterface, \Iterator
{
    /**
     * @var \SplFileObject
     */
    private $reader;

    private $columnNames;

    private $firstRowUsedAsColumnName;

    public function load(string $filePath, string $delimiter = ',', string $fieldEnclosure = '"', string $escapeChar = '\\'): self
    {
        $this->firstRowUsedAsColumnName = false;
        $this->reader = new \SplFileObject($filePath, 'r');
        $this->reader->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        return $this;
    }

    public function getColumnNames(): array
    {
        return $this->columnNames;
    }

    private function setColumnNames(array $names, $firstRowUsedAsNames = false)
    {
        if ($firstRowUsedAsNames) {
            $this->firstRowUsedAsColumnName = true;
        }

        array_walk($names, function (&$value, $key) {
            if ($value === '') {
                $value = "COL_$key";
            }
        });
        $this->columnNames = $names;

        return $this;
    }

    public function useFirstRowAsHeader(): self
    {
        $this->reader->next();
        $this->setColumnNames($this->reader->current(), true);

        return $this;
    }

    public function current()
    {
        $row = $this->reader->current();

        if (!$row) {
            return [];
        }

        if ($this->firstRowUsedAsColumnName && $this->reader->key() < 1) {
            $this->reader->next();
            $row = $this->reader->current();
        }

        while (count($row) < count($this->columnNames)) {
            $this->reader->next();
            array_pop($row);
            $row = array_merge($row, $this->reader->current());
        }

        if (count($row) != count($this->columnNames)) {
            throw new FileBadlyFormattedException($this->key());
        }

        return array_combine($this->columnNames, $row);
    }

    public function valid()
    {
        return $this->reader->valid();
    }

    public function key()
    {
        return $this->reader->key();
    }

    public function next()
    {
        $this->reader->next();
    }

    public function rewind()
    {
        $this->reader->rewind();
    }

    public function support(string $type)
    {
        return $type === 'csv';
    }
}
