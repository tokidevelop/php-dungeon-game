<?php

declare(strict_types=1);

namespace App\Collection;

use App\Entity\Room;
use App\Exception\RoomNotFoundException;

use function array_key_exists;
use function array_values;
use function sprintf;

final class Rooms
{
    /** @var array<string, Room> */
    private array $rooms = [];

    public function add(Room $room): void
    {
        $id = $room->id();
        $this->rooms[$id] = $room;
    }

    public function getById(string $id): Room
    {
        if (array_key_exists($id, $this->rooms) === false) {
            throw new RoomNotFoundException(sprintf('Room with id "%s" not found.', $id));
        }

        return $this->rooms[$id];
    }

    /**
     * @return list<Room>
     */
    public function all(): array
    {
        return array_values($this->rooms);
    }
}