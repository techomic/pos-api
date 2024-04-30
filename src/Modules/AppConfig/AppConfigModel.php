<?php

namespace Vikuraa\Modules\AppConfig;

use DI\Container;
use Vikuraa\Core\Model;

class AppConfigModel extends Model
{
    private string $tableName;

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->tableName = $this->container->get('settings')['db']['table_prefix'] . 'app_config';
    }
}