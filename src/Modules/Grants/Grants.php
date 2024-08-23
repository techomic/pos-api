<?php

namespace Vikuraa\Modules\Grants;

use Vikuraa\Core\Collection;

class Grants extends Collection
{
    public function __construct()
    {
        parent::__construct(Grant::class);
    }

    public function addAll(array $grants) : void
    {
        foreach ($grants as $grant) {
            $this->add($grant);
        }
    }

    public function addFromDbArray(array $data) : void
    {
        $grant = Grant::fromDbArray($data);
        $this->add($grant);
    }

    public function addAllFromDbArray(array $data) : void
    {
        foreach ($data as $row) {
            $this->addFromDbArray($row);
        }
    }
}