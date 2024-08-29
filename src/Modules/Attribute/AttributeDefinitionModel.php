<?php

namespace Vikuraa\Modules\Attribute;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\DatabaseException;
use DateTime;
use Vikuraa\Exceptions\NoDataException;

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

    /**
	 * Determines if a given attribute_value exists in the attribute_values table and returns the attribute_id if it does
	 *
	 * @param float|string $attributeValue The value to search for in the attribute values table.
	 * @param string $definitionType The definition type which will dictate which column is searched.
	 * @return int|bool The attribute ID of the found row or false if no attribute value was found.
	 */
	public function valueExists(float|string $attributeValue, string $definitionType = TEXT): bool|int
	{

		switch($definitionType) {
			case DATE:
				$dataType = 'date';
				$attributeDateValue = DateTime::createFromFormat($this->config->getValue('dateformat'), $attributeValue);
				$attributeValue = $attributeDateValue->format('Y-m-d');
				break;
			case DECIMAL:
				$dataType = 'decimal';
				break;
			default:
				$dataType = 'value';
				break;
		}

        $sql = "select attribute_id from attribute_values where attribute_$dataType = :attribute_value";
		
        $args = ['attribute_value' => $attributeValue];
		
        $data = $this->db->query($sql, $args);

		if(is_array($data) && count($data) > 0) {
			return $data['attribute_id'];
		}

		return false;
	}

    /**
	 * Gets information about a particular attribute definition
	 */
	public function getInfo(int $definitionId): AttributeDefinition|AttributeDefinitions
	{
        $sql = "
            select parent_definition.definition_name as definition_group, definition.*
            from attribute_definitions definition
            left join attribute_definitions parent_definition parent_definition.definition_id = definition.definition_fk
            where definition.definition_id = :definition_id
        ";
		$args = ['definition_id' => $definitionId];

		$data = $this->db->query($sql, $args);

        if (!is_array($data)) {
            throw new NoDataException('No attribute definitions found');
        }

		if (count($data) == 1) {
			return AttributeDefinition::fromDbArray($data);
		}

        $attributeDefinitions = new AttributeDefinitions();

        $attributeDefinitions->addAllFromDbArray($data);

        return $attributeDefinitions;
	}

    /**
	 * Performs a search on attribute definitions
	 */
	public function search(string $query, ?int $limit = 0, int $offset = 0, string $sort = 'definition.definition_name', string $order = 'asc'): AttributeDefinitions
	{
        $sql = "
            select parent_definition.definition_name as definition_group, definition.*
            from attribute_definitions definition
            left join attribute_definitions parent_definition on parent_definition.definition_id = definition.definition_fk
            where
                (
                    definition.definition_name like concat('%', cast(:query as text), '%')
                    or definition.definition_type like concat('%', cast(:query as text), '%')
                )
                and definition.deleted = false
                order by {$sort} $order
        ";

		$args = ['query' => $query];

        $data = $this->db->query($sql, $args);

        if (!is_array($data) || count($data) == 0) {
            throw new NoDataException('No attribute definitions found');
        }

		if ($limit > 0) {
            $sql .= " limit cast(:limit as int) offset cast(:offset as int) ";
            $args['limit'] = $limit;
            $args['offset'] = $offset;
        }

        $definitions = new AttributeDefinitions();
        $definitions->addAllFromDbArray($data);
		return $definitions;
	}

    /**
	 * Gets all attributes connected to an item given the item_id
	 *
	 * @param int $itemId Item to retrieve attributes for.
	 * @return array Attributes for the item.
	 */
	public function byItemId(int $itemId): array
	{
        // TODO: understand this method and fix it
		$builder = $this->db->table('attribute_definitions');
		$builder->join('attribute_links', 'attribute_links.definition_id = attribute_definitions.definition_id');
		$builder->where('item_id', $item_id);
		$builder->where('sale_id', null);
		$builder->where('receiving_id', null);
		$builder->where('deleted', 0);
		$builder->orderBy('definition_name', 'ASC');

		$results = $builder->get()->getResultArray();

		return $this->to_array($results, 'definition_id');
	}
}