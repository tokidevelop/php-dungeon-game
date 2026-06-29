<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Monster;
use App\Entity\Player;
use App\Entity\Room;
use App\Entity\Treasure;
use App\Enum\RoomContent;
use App\Exception\UnsupportedRoomContentException;
use App\Result\RoomInteractionResult;
use Random\RandomException;

use function sprintf;

final readonly class RoomInteractionService
{
    public function __construct(
        private CombatService $combatService,
    ) {
    }

    public function interact(Player $player, Room $room): RoomInteractionResult
    {
        return match ($room->content()) {
            RoomContent::Empty => RoomInteractionResult::continue('The room is empty.'),
            RoomContent::Monster => $this->handleMonster($player, $room),
            RoomContent::Treasure => $this->handleTreasure($player, $room),
            RoomContent::Exit => RoomInteractionResult::finish(sprintf('You found the exit. Final score: %d', $player->score())),
            default => throw new UnsupportedRoomContentException('Invalid room content.'),
        };
    }

    /**
     * @throws RandomException
     */
    private function handleMonster(Player $player, Room $room): RoomInteractionResult
    {
        $monster = $room->monster();

        if (! $monster instanceof Monster) {
            return RoomInteractionResult::continue('There should be a monster here, but the room is empty.');
        }

        $combatResult = $this->combatService->fight($player, $monster);
        if ($player->isAlive() === false) {
            return RoomInteractionResult::finish($combatResult->message());
        }

        $room->clear();

        return RoomInteractionResult::continue($combatResult->message());
    }

    private function handleTreasure(Player $player, Room $room): RoomInteractionResult
    {
        $treasure = $room->treasure();

        if (! $treasure instanceof Treasure) {
            return RoomInteractionResult::continue('There should be treasure here, but the room is empty.');
        }

        $player->collect($treasure);
        $room->clear();

        return RoomInteractionResult::continue(
            sprintf(
                'You found %s worth %d points.',
                $treasure->name(),
                $treasure->points(),
            ),
        );
    }
}
