<?php

declare(strict_types=1);

namespace App\Config;

final readonly class DungeonConfig
{
    public function __construct(
        public int $roomCount = 5
    ) {
    }

    public function getRoomCount(): int
    {
        return $this->roomCount;
    }


}