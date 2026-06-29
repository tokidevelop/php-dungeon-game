<?php

declare(strict_types=1);

namespace App\Enum;

enum Direction: string
{
    case North = 'north';
    case South = 'south';
    case East = 'east';
    case West = 'west';
}
