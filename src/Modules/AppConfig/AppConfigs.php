<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Collection;

class AppConfigs extends Collection
{
    public function __construct()
    {
        parent::__construct(AppConfig::class);
    }
}