<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\Direction;
use App\Exception\UnsupportedDirectionException;

use function sprintf;

final readonly class DirectionParser
{
    public function parseDirection(string $direction): Direction
    {
        return match ($direction) {
            'north', 'n' => Direction::North,
            'south', 's' => Direction::South,
            'east', 'e' => Direction::East,
            'west', 'w' => Direction::West,
            default => throw new UnsupportedDirectionException(sprintf('Unsupported direction: %s', $direction)),
        };
    }
}