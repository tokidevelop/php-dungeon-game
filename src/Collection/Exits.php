<?php

declare(strict_types=1);

namespace App\Collection;

use App\Enum\Direction;

use function array_keys;
use function array_values;

final class Exits
{
    /** @var array<string, string> */
    private array $exits = [];

    public function add(Direction $direction, string $roomId): void
    {
        $this->exits[$direction->value] = $roomId;
    }

    public function get(Direction $direction): ?string
    {
        return $this->exits[$direction->value] ?? null;
    }

    /** @return list<string> */
    public function directions(): array
    {
        return array_values(array_keys($this->exits));
    }
}
