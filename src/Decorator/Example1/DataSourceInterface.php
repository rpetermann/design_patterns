<?php

namespace App\Decorator\Example1;

interface DataSourceInterface
{
    public function writeData(string $data): void;

    public function readData(): string;
}
