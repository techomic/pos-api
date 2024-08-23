<?php

namespace Vikuraa\Modules\Grants;

use Vikuraa\Core\Entity;

class Grant extends Entity
{
    protected string $permissionId;
    protected int $personId;
    protected string $menuGroup;

    public static function fromDbArray(array $data): static
    {
        $grant = new static();

        $grant->permissionId = $data['permission_id'];
        $grant->personId = $data['person_id'];
        $grant->menuGroup = $data['menu_group'];

        return $grant;
    }
}