<?php

namespace Test\Decorator\Example1;

use App\Decorator\Example1\Application;
use App\Decorator\Example1\ApplicationConfiguration;
use Test\AbstractTestCase;

class ReadTest extends AbstractTestCase
{
    protected const FILENAME = 'test.txt';
    protected const DEFAULT_DATA = 'abcdefghijkl9876$%1\/';

    public function tearDown(): void
    {
        unlink(self::FILENAME);
    }

    public function dataProviderSucessfullyLoad(): array
    {
        return [
            'without compression and without encryption using default data' => [
                'hasCompression' => false,
                'hasEncryption' => false,
                'data' => self::DEFAULT_DATA,
            ],
            'with compression and without encryption using default data' => [
                'hasCompression' => true,
                'hasEncryption' => false,
                'data' => self::DEFAULT_DATA,
            ],
            'without compression and with encryption using default data' => [
                'hasCompression' => false,
                'hasEncryption' => true,
                'data' => self::DEFAULT_DATA,
            ],
            'with compression and with encryption using default data' => [
                'hasCompression' => true,
                'hasEncryption' => true,
                'data' => self::DEFAULT_DATA,
            ],
            'without compression and without encryption using random data' => [
                'hasCompression' => false,
                'hasEncryption' => false,
                'data' => $this->getRandomData(),
            ],
            'with compression and without encryption using random data' => [
                'hasCompression' => true,
                'hasEncryption' => false,
                'data' => $this->getRandomData(),
            ],
            'without compression and with encryption using random data' => [
                'hasCompression' => false,
                'hasEncryption' => true,
                'data' => $this->getRandomData(),
            ],
            'with compression and with encryption using random data' => [
                'hasCompression' => true,
                'hasEncryption' => true,
                'data' => $this->getRandomData(),
            ],
        ];
    }

    /**
     * @dataProvider dataProviderSucessfullyLoad
     */
    public function testSucessfullyLoad(bool $hasCompression, bool $hasEncryption, string $data): void
    {
        $configuration = new ApplicationConfiguration(
            $hasCompression,
            $hasEncryption,
        );
        $application = new Application($configuration);

        $application->save(self::FILENAME, $data);
        $response = $application->load(self::FILENAME);

        $this->assertSame($data, $response);
    }

    protected function getRandomData(): string
    {
        return str_shuffle(str_repeat('1234567890' . implode('', range('a', 'z')), 5));
    }
}