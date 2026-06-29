<?php

declare(strict_types=1);

namespace App\Config;

final readonly class CombatConfig
{
    public function __construct(
        public PlayerConfig $player,
        public MonsterConfig $monster,
    ) {
    }
}