<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\DatabaseException;

class AttributeDefinitionModel extends Model
{
    /**
     * Checks if a definition exists.
     * 
     * @param int $id
     * @param bool $deleted
     * @return bool
     * @throws DatabaseException if no definition is found
     */
    public function exists(int $id, bool $deleted = false): bool
    {
        $sql = "SELECT * FROM attribute_definitions WHERE id = :id AND deleted = :deleted";

        return $this->db->count($sql, ['id' => $id, 'deleted' => $deleted]) > 0;
    }
}