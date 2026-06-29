<?php

declare(strict_types=1);

namespace App\Entity;

use App\DTO\ExitCollection;
use App\Enum\Direction;
use App\Enum\RoomContent;

final class Room
{
    private ExitCollection $exits;

    public function __construct(
        private readonly string $id,
        private RoomContent $content,
        private ?Monster $monster = null,
        private ?Treasure $treasure = null,
    ) {
        $this->exits = new ExitCollection();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function content(): RoomContent
    {
        return $this->content;
    }

    public function monster(): ?Monster
    {
        return $this->monster;
    }

    public function treasure(): ?Treasure
    {
        return $this->treasure;
    }

    public function connect(Direction $direction, string $roomId): void
    {
        $this->exits->add($direction, $roomId);
    }

    public function nextRoomId(Direction $direction): ?string
    {
        return $this->exits->get($direction);
    }

    public function exits(): ExitCollection
    {
        return $this->exits;
    }

    public function clear(): void
    {
        $this->content = RoomContent::Empty;
        $this->monster = null;
        $this->treasure = null;
    }
}
