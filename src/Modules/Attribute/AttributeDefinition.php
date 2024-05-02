<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Entity;
use ReflectionClass;

class AttributeDefinition extends Entity
{
    const SHOW_IN_ITEMS = 1;
	const SHOW_IN_SALES = 2;
	const SHOW_IN_RECEIVINGS = 4;

    protected $id;
    protected $name;
    protected $type;
    protected $unit;
    protected $flags;
    protected $fk;
    protected $deleted;

    public static function fromDbArray(array $row): static
    {
        $entity = new static();
        $entity->id = $row['id'];
        $entity->name = $row['name'];
        $entity->type = $row['type'];
        $entity->unit = $row['unit'];
        $entity->flags = $row['flags'];
        $entity->fk = $row['fk'];
        $entity->deleted = $row['deleted'];

        return $entity;
    }

    public static function getFlags(): array
    {
        $class = new ReflectionClass(static::class);
        return array_flip($class->getConstants());
    }
}