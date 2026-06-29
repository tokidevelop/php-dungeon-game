<?php

declare(strict_types=1);

namespace App\Collection;

final class Inventory
{
    /** @var list<string> */
    private array $items = [];

    public function add(string $item): void
    {
        $this->items[] = $item;
    }

    /** @return list<string> */
    public function all(): array
    {
        return $this->items;
    }
}
