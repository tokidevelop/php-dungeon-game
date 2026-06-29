<?php

declare(strict_types=1);

namespace App\Entity;

final readonly class Treasure
{
    public function __construct(
        private string $name,
        private int $points,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function points(): int
    {
        return $this->points;
    }
}
