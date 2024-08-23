<?php

use DI\ContainerBuilder;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;
use Vikuraa\Helpers\RoundingMode;
use Vikuraa\Helpers\DomPdfCreator;
use Vikuraa\Helpers\Common;
use Vikuraa\Helpers\Security;
use Vikuraa\Helpers\Jwt;
use Vikuraa\Helpers\EncryptionInterface;
use Vikuraa\Helpers\Encryption;
use Vikuraa\Helpers\Cache;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $logger = new Logger('app');

            // $pgHandler = new PostgresLogHandler($c);

            // $logger->pushHandler($pgHandler);
            if (getenv('APP_DEBUG') == 1) {
                $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log'));
            }

            return $logger;
        },
        
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

        Cache::class => function (ContainerInterface $c) {
            return new Cache($c);
        }
    ]);
};
