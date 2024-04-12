<?php

namespace Vikuraa\Helpers;

interface EncryptionInterface
{
    public function hash(string $password): string;
    public function verify(string $password, string $hash): bool;

    public function encrypt(string $data): string;
    public function decrypt(string $data): string;
}