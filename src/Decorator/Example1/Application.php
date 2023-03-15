<?php

namespace App\Decorator\Example1;

class Application
{
    protected $configuration;

    public function __construct(ApplicationConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function save(string $filename, string $data): void
    {
        $source = $this->configuration->configure($filename);

        $source->writeData($data);
    }

    public function load(string $filename): string
    {
        $source = $this->configuration->configure($filename);

        return $source->readData($filename);
    }
}
