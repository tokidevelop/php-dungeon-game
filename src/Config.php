<?php

declare(strict_types=1);

namespace App;

use App\Config\CombatConfig;
use App\Config\DungeonConfig;

final class Config
{
    public function __construct(
        public CombatConfig $combat,
        public DungeonConfig $dungeon,
    ) {
    }
}