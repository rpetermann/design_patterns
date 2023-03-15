<?php

namespace App\Decorator\Example1;

abstract class AbstractDataDecorator implements DataSourceInterface
{
    protected $wrappee;

    public function __construct(DataSourceInterface $wrappee)
    {
        $this->wrappee = $wrappee;
    }

    public function writeData(string $data): void
    {
        $this->wrappee->writeData($data);
    }

    public function readData(): string
    {
        return $this->wrappee->readData();
    }
}
