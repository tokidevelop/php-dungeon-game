<?php

declare(strict_types=1);

namespace App\Factory;

use App\Collection\Rooms;
use App\Config;
use App\Entity\Dungeon;
use App\Entity\Monster;
use App\Entity\Room;
use App\Entity\Treasure;
use App\Enum\Direction;
use App\Enum\RoomContent;
use Random\RandomException;

use function sprintf;

final readonly class DungeonFactory
{
    private const EMPTY_CHANCE = 45;
    private const MONSTER_CHANCE = 75;

    public function __construct(
        private Config $config
    ) {
    }

    /**
     * @throws RandomException
     */
    public function create(): Dungeon
    {
        $rooms = new Rooms();
        $rooms->add(
            new Room(id: 'entrance', content: RoomContent::Empty)
        );

        for ($index = 1; $index <= $this->config->dungeon->getRoomCount(); $index++) {
            $rooms->add(
                $this->createRandomRoom($index)
            );
        }

        $rooms->add(
            new Room(id: 'exit', content: RoomContent::Exit)
        );

        $this->connectRooms($rooms);

        return new Dungeon(rooms: $rooms, currentRoomId: 'entrance');
    }

    /**
     * @throws RandomException
     */
    private function createRandomRoom(int $index): Room
    {
        $roll = random_int(1, 100);
        if ($roll <= self::EMPTY_CHANCE) {
            return new Room(
                id: sprintf('Room #%d', $index),
                content: RoomContent::Empty
            );
        }

        if ($roll <= self::MONSTER_CHANCE) {
            return new Room(
                id: sprintf('Room #%d', $index),
                content: RoomContent::Monster,
                monster: new Monster(
                    hitPoints: random_int(
                        $this->config->combat->monster->getMinHitPoints(),
                        $this->config->combat->monster->getMaxHitPoints()
                    ),
                    minDamage: $this->config->combat->monster->getMinDamage(),
                    maxDamage: $this->config->combat->monster->getMaxDamage(),
                )
            );
        }

        return new Room(
            id: sprintf('Room #%d', $index),
            content: RoomContent::Treasure,
            treasure: new Treasure(name: 'Treasure Chest', points: random_int(50, 200)),
        );
    }

    private function connectRooms(Rooms $rooms): void
    {
        $orderedRooms = $rooms->all();
        for ($index = 0; $index < count($orderedRooms) - 1; $index++) {
            $currentRoom = $orderedRooms[$index];
            $nextRoom = $orderedRooms[$index + 1];

            $currentRoom->connect(Direction::North, $nextRoom->id());
            $nextRoom->connect(Direction::South, $currentRoom->id());
        }
    }
}