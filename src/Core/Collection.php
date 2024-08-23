<?php

namespace Vikuraa\Core;

use IteratorAggregate;
use Traversable;
use ArrayIterator;
use InvalidArgumentException;
use OutOfRangeException;

abstract class Collection implements IteratorAggregate
{
    protected string $valueType;
    protected bool $isBasicType = false;
    protected string $validateFunc;
    protected array $items = [];
    protected int $lastIndex = 0;

    
    public function __construct(string $valueType)
    {
        $this->valueType = $valueType;
        if (function_exists("is_$valueType")) {
            $this->isBasicType = true;
            $this->validateFunc = "is_$valueType";
        }
    }

    /**
     * Add a value to the collection.
     * 
     * @param $value
     * @throws InvalidArgumentException when wrong type
     */
    public function add($value)
    {
        if (!$this->isValidType($value)) {
            throw new InvalidArgumentException('Trying to add a value of wrong type');
        }
        $this->items[] = $value;
    }

    /**
     * Set index's value.
     * 
     * @param int $index
     * @param mixed $value
     * @throws OutOfRangeException
     * @throws InvalidArgumentException
     */
    public function set(int $index, mixed $value)
    {
        if ($index >= $this->count()) {
            throw new OutOfRangeException('Index out of range');
        }
        if (!$this->isValidType($value)) {
            throw new InvalidArgumentException('Trying to add a value of wrong type');
        }

        $this->items[$index] = $value;
    }

    /**
     * Remove a value from the collection.
     * 
     * @param int $index to remove
     * @throws OutOfRangeException if index is out of range
     */
    public function remove(int $index)
    {
        if ($index >= $this->count()) {
            throw new OutOfRangeException('Index out of range');
        }
        array_splice($this->items, $index, 1);
    }

    /**
     * Get the value at index.
     * 
     * @param int $index
     * @return mixed
     * @throws OutOfRangeException
     */
    public function get(int $index): mixed
    {
        if ($index >= $this->count()) {
            throw new OutOfRangeException('Index out of range');
        }
        return $this->items[$index];
    }

    /**
     * Determine if index exists.
     * 
     * @param int $index
     * @return bool
     */
    public function exists(int $index): bool
    {
        return $index < $this->count();
    }

    /**
     * Return number of items in collection.
     * 
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Determine if this value can be added to this collection.
     * 
     * @param mixed $value
     * @return bool
     */
    protected function isValidType($value): bool
    {
        if ($this->isBasicType) {
            $validateFunc = $this->validateFunc;
            return $validateFunc($value);
        } else {
            return $value instanceof $this->valueType;
        }
    }

    /**
     * Return an iterator.
     * 
     * @return ArrayIterator
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Determine if there is a next element.
     * 
     * @return bool
     */
    public function hasNext(): bool
    {
        return $this->exists($this->lastIndex);
    }

    /**
     * Get the next element.
     * 
     * @return mixed
     * @throws OutOfRangeException
     */
    public function next(): mixed
    {
        if ($this->exists($this->lastIndex)) {
            $element = $this->get($this->lastIndex);
            $this->lastIndex++;
            return $element;
        } else {
            throw new OutOfRangeException('Index out of range');
        }
    }

    /**
     * Convert an array to a collection.
     * 
     * @param array $array
     * @return Collection
     * @throws InvalidArgumentException
     */
    public function fromArray(array $array): Collection
    {
        if (is_array($array)) {
            foreach ($array as $val) {
                if ($this->isValidType($val)) {
                    $this->add($val);
                }
            }
            return $this;
        } else {
            throw new InvalidArgumentException('$array is not an array.');
        }
    }

    /**
     * Convert the collection to an array.
     * 
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    public function toArrayDeep(): array
    {
        if ($this->isBasicType) {
            return $this->items;
        }

        $array = [];
        foreach ($this->items as $item) {
            if ($item instanceof Entity) {
                $array[] = $item->toArray();
            } else {
                $array[] = get_object_vars($item);
            }
        }
        return $array;
    }

    abstract public function addAll(array $items) : void;
    abstract public function addFromDbArray(array $data) : void;
    abstract public function addAllFromDbArray(array $data) : void;
}