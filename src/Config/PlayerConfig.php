<?php

declare(strict_types=1);

namespace App\Config;

final readonly class PlayerConfig
{
    public function __construct(
        private int $hitPoints = 30,
        private int $minDamage = 5,
        private int $maxDamage = 10,
    ) {
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
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