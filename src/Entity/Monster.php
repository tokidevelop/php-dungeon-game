<?php

declare(strict_types=1);

namespace App\Entity;

use Random\RandomException;

use function max;
use function random_int;

final class Monster
{
    public function __construct(
        private int $hitPoints,
        private readonly int $minDamage,
        private readonly int $maxDamage,
    ) {
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    /**
     * @throws RandomException
     */
    public function attack(): int
    {
        return random_int(
            $this->minDamage,
            $this->maxDamage,
        );
    }

    public function takeDamage(int $damage): void
    {
        $this->hitPoints = max(0, $this->hitPoints - $damage);
    }

    public function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }
}
