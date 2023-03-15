<?php

namespace App\Decorator\Example1;

class ApplicationConfiguration
{
    /**
     * @var boolean
     */
    protected $hasCompression;

    /**
     * @var boolean
     */
    protected $hasEncryption;

    public function __construct(bool $hasCompression = false, bool $hasEncryption = false)
    {
        $this->hasCompression = $hasCompression;
        $this->hasEncryption = $hasEncryption;
    }

    public function configure(string $filename): DataSourceInterface
    {
        $source = new FileDataSource($filename);

        if ($this->hasCompression) {
            $source = new CompressionDecorator($source);
        }
        if ($this->hasEncryption) {
            $source = new EncryptionDecorator($source);
        }

        return $source;
    }
}
