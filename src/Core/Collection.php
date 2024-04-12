<?php

namespace Vikuraa\Core;

use Countable;
use Iterator;

abstract class Collection implements Countable, Iterator
{
    protected array $items = [];

    public function count(): int
    {
        return count($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function valid(): bool
    {
        return key($this->items) !== null;
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function add(Entity $entity): void
    {
        $this->items[] = $entity;
    }
}