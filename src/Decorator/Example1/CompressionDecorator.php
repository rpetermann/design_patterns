<?php

namespace App\Decorator\Example1;

class CompressionDecorator extends AbstractDataDecorator
{
    protected const COMPRESSION_LEVEL = 9;

    public function writeData(string $data): void
    {
        $dataCompressed = gzdeflate($data,  self::COMPRESSION_LEVEL);

        parent::writeData($dataCompressed);
    }

    public function readData(): string
    {
        $dataCompressed = parent::readData();

        return gzinflate($dataCompressed);
    }
}
