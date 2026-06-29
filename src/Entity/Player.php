<?php

declare(strict_types=1);

namespace App\Entity;

use App\DTO\Inventory;
use Random\RandomException;

use function random_int;

final class Player
{
    private Inventory $inventory;

    private int $score = 0;

    public function __construct(
        private int $hitPoints,
        private readonly int $minDamage,
        private readonly int $maxDamage,
    ) {
        $this->inventory = new Inventory();
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

    public function score(): int
    {
        return $this->score;
    }

    public function inventory(): Inventory
    {
        return $this->inventory;
    }

    public function takeDamage(int $damage): void
    {
        $this->hitPoints = max(0, $this->hitPoints - $damage);
    }

    public function collect(Treasure $treasure): void
    {
        $this->inventory->add($treasure->name());
        $this->score += $treasure->points();
    }

    public function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }
}
