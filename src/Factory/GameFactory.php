<?php

declare(strict_types=1);

namespace App\Factory;

use App\CliRenderer;
use App\Config;
use App\Entity\Player;
use App\Game;
use App\Service\CombatService;
use App\Service\DirectionParser;
use App\Service\MovementService;
use App\Service\RoomInteractionService;
use Random\RandomException;

final readonly class GameFactory
{
    /**
     * @throws RandomException
     */
    public static function create(Config $config): Game
    {
        return new Game(
            dungeon: (new DungeonFactory($config))->create(),
            player: new Player(
                hitPoints: $config->combat->player->getHitPoints(),
                minDamage: $config->combat->player->getMinDamage(),
                maxDamage: $config->combat->player->getMaxDamage(),
            ),
            movementService: new MovementService(),
            roomInteractionService: new RoomInteractionService(new CombatService()),
            directionParser: new DirectionParser(),
            renderer: new CliRenderer(),
        );
    }
}