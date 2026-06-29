<?php

declare(strict_types=1);

namespace App\Config;

final readonly class MonsterConfig
{
    public function __construct(
        private int $minHitPoints = 10,
        private int $maxHitPoints = 25,
        private int $minDamage = 2,
        private int $maxDamage = 6,
    ) {
    }

    public function getMinHitPoints(): int
    {
        return $this->minHitPoints;
    }

    public function getMaxHitPoints(): int
    {
        return $this->maxHitPoints;
    }

    public function getMinDamage(): int
    {
        return $this->minDamage;
    }

    public function getMaxDamage(): int
    {
        return $this->maxDamage;
    }


}