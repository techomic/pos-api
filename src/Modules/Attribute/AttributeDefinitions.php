<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Collection;

class AttributeDefinitions extends Collection
{
    public function __construct()
    {
        parent::__construct(AttributeDefinition::class);
    }
}