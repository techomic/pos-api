<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'app' => [
                'name' => getenv('APP_NAME'),
                'language' => getenv('APP_LANG'),
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
