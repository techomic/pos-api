<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\DatabaseException;
use DateTime;
use Vikuraa\Exceptions\NoDataException;

class AttributeLinkModel extends Model
{
    /**
	 * Returns whether an attribute_link row exists given an item_id and optionally a definition_id
	 * @param int $itemId ID of the item to check for an associated attribute.
	 * @param bool $definitionId Attribute definition ID to check.
	 * @return bool returns true if at least one attribute_link exists or false if no attributes exist for that item and attribute.
	 */
    public function exists(int $itemId, ?int $definitionId)
    {
        $sql = "select * from attribute_links where item_id = :item_id and sale_id is null and receiving_id is null ";

        $args = [
            'item_id' => $itemId,
        ];

        if ($definitionId == null) {
            $sql .= " and definition_id is not null and attribute_id is null ";
        } else {
            $sql .= " and definition_id = :definition_id ";
            $args['definition_id'] = $definitionId;
        }
        
        
        return $this->db->count($sql, $args) > 0;
    }
}