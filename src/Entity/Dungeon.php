<?php

declare(strict_types=1);

namespace App\Entity;

use App\Collection\Rooms;
use App\Enum\Direction;

use function is_string;

final class Dungeon
{
    public function __construct(
        private readonly Rooms $rooms,
        private string $currentRoomId,
    ) {
    }

    public function currentRoom(): Room
    {
        return $this->rooms->getById($this->currentRoomId);
    }

    public function move(Direction $direction): bool
    {
        $nextRoomId = $this->currentRoom()->nextRoomId($direction);
        if (is_string($nextRoomId) === false) {
            return false;
        }

        $this->currentRoomId = $nextRoomId;

        return true;
    }
}
