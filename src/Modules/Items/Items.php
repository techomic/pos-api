
<?php

namespace Vikuraa\Modules\Items;


use Vikuraa\Core\Collection;

class Items extends Collection
{
    public function __construct()
    {
        parent::__construct(Item::class);
    }

    /**
     * Add multiple items to the collection.
     *
     * @param array $items
     * @return void
     */
    public function addAll(array $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Add an item from a database array.
     *
     * @param array $row
     * @return void
     */
    public function addFromDbArray(array $row): void
    {
        $this->add(Item::fromDbArray($row));
    }

    /**
     * Add multiple items from database arrays.
     *
     * @param array $dbArrays
     * @return void
     */
    public function addAllFromDbArray(array $data): void
    {
        foreach ($data as $row) {
            $this->addFromDbArray($row);
        }
    }
}
