<?php

namespace Vikuraa\Helpers;

class Encryption implements EncryptionInterface
{
    private $container;
    private $iv = '';
    private $key = '';

    public function __construct($container)
    {
        $this->container = $container;
        $this->key = $this->container->get('settings')['security']['enc_key'];
        $this->iv = $this->container->get('settings')['security']['enc_iv'];
    }

    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function encrypt(string $data): string
    {
        return openssl_encrypt($data, 'aes-256-cbc', $this->key, 0, $this->iv);
    }

    public function decrypt(string $data): string
    {
        return openssl_decrypt($data, 'aes-256-cbc', $this->key, 0, $this->iv);
    }
}