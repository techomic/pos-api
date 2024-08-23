<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'app' => [
                'name' => getenv('APP_NAME'),
                'domain' => getenv('DOMAIN'),
                'language' => getenv('APP_LANG'),
                'charset' => getenv('CHARSET') ?? 'UTF-8',
            ],
            'security' => [
                'enc_key' => getenv('ENC_KEY'),
                'enc_iv' => getenv('ENC_IV'),
                'jwt_key' => getenv('JWT_KEY'),
                'csrf_protection' => boolval(getenv('CSRF_PROTECTION')),
                'csrf_expire' => getenv('CSRF_EXPIRE') ?? 7200, // 2 hours
                'csrf_token_name' => getenv('CSRF_TOKEN_NAME') ?? 'vikuara_csrf_token',
                'csrf_cookie_name' => getenv('CSRF_COOKIE_NAME') ?? 'vikuara_csrf_cookie',
                'csrf_regenerate' => boolval(getenv('CSRF_REGENERATE')),
                'csrf_exclude_uris' => getenv('CSRF_EXCLUDE_URIS') ?? [],
                'cookie_secure' => boolval(getenv('COOKIE_SECURE')),
                'cookie_path' => getenv('COOKIE_PATH') ?? '/',
                'cookie_domain' => getenv('COOKIE_DOMAIN') ?? null,
                'cookie_httponly' => boolval(getenv('COOKIE_HTTPONLY')),
            ],
            'db' => [
                'host'      =>  getenv('DB_HOST') ?? 'localhost',
                'port'      =>  getenv('DB_PORT') ?? 5432,
                'sslmode'   =>  getenv('DB_SSLMODE') ?? 'disable', // 'prefer' or 'require
                'name'      =>  getenv('DB_NAME') ?? 'vikuraa',
                'username'  =>  getenv('DB_USER') ?? 'postgres',
                'password'  =>  getenv('DB_PASSWORD') ?? '',
            ],
            'valkey' => [
                'scheme'    => getenv('VALKEY_SCHEME') ?? 'tcp',
                'host'      => getenv('VALKEY_HOST') ?? 'vikuraa-valkey',
                'port'      => getenv('VALKEY_PORT') ?? 6379,
            ],
        ],
    ]);
};
