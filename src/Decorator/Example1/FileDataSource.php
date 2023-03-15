<?php

namespace App\Decorator\Example1;

class FileDataSource implements DataSourceInterface
{
    protected $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function writeData(string $data): void
    {
        file_put_contents($this->filename, $data, LOCK_EX);
    }

    public function readData(): string
    {
        return file_get_contents($this->filename);
    }
}
