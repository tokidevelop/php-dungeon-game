<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Dungeon;
use App\Enum\Direction;

final readonly class MovementService
{
    public function move(Dungeon $dungeon, Direction $direction): bool
    {
        return $dungeon->move($direction);
    }
}
