<?php

declare(strict_types=1);

namespace App;

use App\Entity\Player;
use App\Entity\Room;

use function implode;
use function sprintf;
use function trim;

final readonly class CliRenderer
{
    public function showRoom(Room $room, Player $player): void
    {
        echo PHP_EOL . sprintf('You are in room: %s', $room->id()) . PHP_EOL;
        echo sprintf('HP: %d | Score: %d', $player->hitPoints(), $player->score()) . PHP_EOL;
        echo sprintf('Exits: %s', implode(', ', $room->exits()->directions())) . PHP_EOL;
    }

    public function showMessage(string $message): void
    {
        echo sprintf('%s', $message) . PHP_EOL;
    }

    public function askCommand(): string
    {
        echo '> ';

        $input = fgets(STDIN);
        if (is_string($input) === false) {
            return 'quit';
        }

        return trim($input);
    }
}
