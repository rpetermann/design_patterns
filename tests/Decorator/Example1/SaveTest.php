<?php

namespace Test\Decorator\Example1;

use App\Decorator\Example1\Application;
use App\Decorator\Example1\ApplicationConfiguration;
use Test\AbstractTestCase;

class SaveTest extends AbstractTestCase
{
    protected const FILENAME = 'test.txt';

    public function tearDown(): void
    {
        unlink(self::FILENAME);
    }

    public function testSucessfullySaveWithoutCompressionAndWithoutEncryption(): void
    {
        $filename = self::FILENAME;
        $data = 'test456Xya%4#9';

        $configuration = new ApplicationConfiguration(
            false,
            false,
        );
        $application = new Application($configuration);

        $application->save($filename, $data);

        $this->assertFileExists($filename);
        $this->assertStringEqualsFile($filename, $data);
    }

    public function testSucessfullySaveWithCompressionAndWithoutEncryption(): void
    {
        $filename = self::FILENAME;
        $data = 'test456Xya%4#9';

        $configuration = new ApplicationConfiguration(
            true,
            false,
        );
        $application = new Application($configuration);

        $application->save($filename, $data);

        $this->assertFileExists($filename);
        $this->assertStringNotEqualsFile($filename, $data);
    }

    public function testSucessfullySaveWithoutCompressionAndWithEncryption(): void
    {
        $filename = self::FILENAME;
        $data = 'test456Xya%4#9';

        $configuration = new ApplicationConfiguration(
            false,
            true,
        );
        $application = new Application($configuration);

        $application->save($filename, $data);

        $this->assertFileExists($filename);
        $this->assertStringNotEqualsFile($filename, $data);
    }

    public function testSucessfullySaveWithCompressionAndWithEncryption(): void
    {
        $filename = self::FILENAME;
        $data = 'test456Xya%4#9';

        $configuration = new ApplicationConfiguration(
            true,
            true,
        );
        $application = new Application($configuration);

        $application->save($filename, $data);

        $this->assertFileExists($filename);
        $this->assertStringNotEqualsFile($filename, $data);
    }
}