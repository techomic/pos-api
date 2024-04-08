<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'app' => [
                'name' => getenv('APP_NAME'),
                'language' => getenv('APP_LANG'),
                'charset' => getenv('CHARSET') ?? 'UTF-8',
            ],
            'security' => [
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
            // 'db' => [
            //     'host'      =>  getenv('DB_HOST'),
            //     'port'      =>  getenv('DB_PORT'),
            //     'name'      =>  getenv('DB_DATABASE'),
            //     'service'   =>  getenv('DB_SERVICE'),
            //     'username'  =>  getenv('DB_USERNAME'),
            //     'password'  =>  getenv('DB_PASSWORD'),
            //     'charset'   =>  getenv('DB_CHARSET'),
            //     'mode'      =>  getenv('DB_MODE'),
            //     'username_omega' => getenv('DB_USERNAME_OMEGA'),
            //     'password_omega' => getenv('DB_PASSWORD_OMEGA'),
            // ],
            
            // 'redis' => [
            //     'scheme'    =>  getenv('REDIS_SCHEME', 'tcp'),
            //     'host'      =>  getenv('REDIS_HOST'),
            //     'port'      =>  getenv('REDIS_PORT'),
            //     'password'  =>  getenv('REDIS_PASSWORD'),
            // ],
            // 'aws' => [
            //     'version'                   => getenv('AWS_CLIENT_VERSION'),
            //     'region'                    => getenv('AWS_CLIENT_REGION'),
            //     'endpoint'                  => getenv('AWS_ENDPOINT'),
            //     'use_path_style_endpoint'   => getenv('AWS_USE_PATH_STYLE_ENDPOINT')
            // ],
        ],
    ]);
};
