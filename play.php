<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Config\CombatConfig;
use App\Config\DungeonConfig;
use App\Config\MonsterConfig;
use App\Config\PlayerConfig;
use App\Factory\GameFactory;

$config = new Config(
    new CombatConfig(
        player: new PlayerConfig(
            hitPoints: 30,
            minDamage: 5,
            maxDamage: 10,
        ),
        monster: new MonsterConfig(
            minHitPoints: 10,
            maxHitPoints: 25,
            minDamage: 2,
            maxDamage: 6,
        ),
    ),
    new DungeonConfig(8)
);

GameFactory::create($config)->run();