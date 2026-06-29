<?php

declare(strict_types=1);

namespace App;

use App\Entity\Dungeon;
use App\Entity\Player;
use App\Enum\Direction;
use App\Exception\UnsupportedDirectionException;
use App\Service\DirectionParser;
use App\Service\MovementService;
use App\Service\RoomInteractionService;

final class Game
{
    private bool $isRunning = true;

    public function __construct(
        private readonly Dungeon $dungeon,
        private readonly Player $player,
        private readonly MovementService $movementService,
        private readonly RoomInteractionService $roomInteractionService,
        private readonly DirectionParser $directionParser,
        private readonly CliRenderer $renderer,
    ) {
    }

    public function run(): void
    {
        $this->renderer->showMessage('Welcome to the dungeon. Commands: north, south, east, west, quit.');

        while ($this->isRunning === true) {
            $this->renderer->showRoom($this->dungeon->currentRoom(), $this->player);

            $command = $this->renderer->askCommand();

            if ($command === 'quit') {
                $this->renderer->showMessage('Game stopped.');
                return;
            }

            try {
                $direction = $this->directionParser->parseDirection($command);
            } catch (UnsupportedDirectionException $e) {
                $this->renderer->showMessage($e->getMessage());
                return;
            }

            $this->handleTurn($direction);
        }
    }

    private function handleTurn(Direction $direction): void
    {
        $hasMoved = $this->movementService->move($this->dungeon, $direction);

        if ($hasMoved === false) {
            $this->renderer->showMessage('You cannot go that way.');
            return;
        }

        $result = $this->roomInteractionService->interact(
            $this->player,
            $this->dungeon->currentRoom(),
        );

        $this->renderer->showMessage($result->message());

        if ($this->player->isAlive() === false) {
            $this->renderer->showMessage('You died... Game over.');
            $this->isRunning = false;
            return;
        }

        if ($result->gameFinished() === true) {
            $this->isRunning = false;
        }
    }
}
