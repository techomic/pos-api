<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Entity;
use ReflectionClass;

class AttributeDefinition extends Entity
{
    protected $id;
    protected $name;
    protected $type;
    protected $unit;
    protected $flags;
    protected $fk;
    protected $deleted;
    protected ?string $definitionGroup;

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
        $entity->definitionGroup = $row['definition_group'] == null ? null : $row['definition_group']; 

        return $entity;
    }
}