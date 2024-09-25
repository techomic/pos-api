<?php

namespace Vikuraa\Modules\Items;

use Vikuraa\Core\Model;

class ItemModel extends Model
{
    public function exists(int $id, bool $ignoreDeleted = false, bool $deleted = false): bool
    {
        $sql = "select * from items where id = :id";

        $args = [
            'id' => $id
        ];

        if (!$ignoreDeleted) {
            $sql .= " and deleted = :del ";
            $args['del'] = $deleted;
        }

        return $this->db->count($sql, $args) > 0;
    }

    public function itemNumberExists(string $itemNumber, string $id): bool
    {
        if (boolval($this->config->getValue('allow_duplicate_barcodes'))) {
            return false;
        }

        $sql = "select * from items where item_number = :item_number deleted = false and id <> :id ";

        if (ctype_digit($id) && !str_starts_with($id, '0')) {
            $sql .= " and id <> :id ";
		}

        $args = [
            'item_number' => $itemNumber,
            'id' => intval($id)
        ];

        return $this->db->count($sql, $args) > 0;
    }

    public function total(): int
    {
        $sql = "select * from items where deleted = false";
        return $this->db->count($sql);
    }

    public function getTaxCategoryUsage(int $taxCategoryId): int
	{
        $sql = "select * from items where tax_category_id = :tax_category_id";
		
        $args = [
            'tax_category_id' => $taxCategoryId
        ];

		return $this->db->count($sql, $args);
	}
}