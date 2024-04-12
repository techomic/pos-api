<?php

use DI\ContainerBuilder;
// use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Vikuraa\Helpers\RoundingMode;
use Vikuraa\Helpers\DomPdfCreator;
use Vikuraa\Helpers\Common;
use Vikuraa\Helpers\Security;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;
use Vikuraa\Helpers\Encryption;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        // LoggerInterface::class => function (ContainerInterface $c) {
        //     $logger = new Logger($c->get('settings')['log_db']['channel']);

        //     $pgHandler = new PostgresLogHandler($c);

        //     $logger->pushHandler($pgHandler);
        //     if (getenv('APP_DEBUG') == 1) {
        //         $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/iims.log'));
        //     }

        //     return $logger;
        // },
        // 'cache' => function (ContainerInterface $c) {
        //     $settings = $c->get('settings')['redis'];
        //     $client = new Client($settings);
        //     return new Cache($client);
        // },
        // 'aws' => function (ContainerInterface $c) {
        //     $settings = $c->get('settings')['aws'];
        //     $settings['use_path_style_endpoint'] = (bool)$settings['use_path_style_endpoint'];
        //     return new S3Client($settings);
        // },
        
        'language' => function (ContainerInterface $c) {
            $appLanguage = $c->get('settings')['app']['language'];
            foreach (glob(__DIR__ . "/../src/Language/{$appLanguage}/*.php") as $language) {
                include $language;
            }
            return $lang;
        },
        
        Common::class => function (ContainerInterface $c) {
            return new Common($c);
        },

        Security::class => function (ContainerInterface $c) {
            return new Security($c);
        },

        Jwt::class => function (ContainerInterface $c) {
            return new Jwt($c);
        },

        RoundingMode::class => function (ContainerInterface $c) {
            return new RoundingMode($c);
        },

        DomPdfCreator::class => function (ContainerInterface $c) {
            return new DomPdfCreator($c);
        },

        EncryptionInterface::class => function (ContainerInterface $c) {
            return new Encryption($c);
        },
    ]);
};
