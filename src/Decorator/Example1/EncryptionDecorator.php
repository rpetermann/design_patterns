<?php

namespace App\Decorator\Example1;

class EncryptionDecorator extends AbstractDataDecorator
{
    // This is just an example.
    // The encryptionKey must be stored in a environment variable.
    private const ENCRYPTION_PASSPHRASE = 'encryptTest';
    private const CYPHER_ALGO = 'AES-128-CTR';
    private const OPTIONS = 0;
    private const INITIALIZATION_VECTOR = "1234567891011121";

    public function writeData(string $data): void
    {
        $dataEncrypted = openssl_encrypt(
            $data,
            self::CYPHER_ALGO,
            self::ENCRYPTION_PASSPHRASE,
            self::OPTIONS,
            self::INITIALIZATION_VECTOR,
        );

        parent::writeData($dataEncrypted);
    }

    public function readData(): string
    {
        $dataEncrypted = parent::readData();

        return openssl_decrypt(
            $dataEncrypted,
            self::CYPHER_ALGO,
            self::ENCRYPTION_PASSPHRASE,
            self::OPTIONS,
            self::INITIALIZATION_VECTOR,
        );
    }
}
