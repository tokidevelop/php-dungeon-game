<?php

declare(strict_types=1);

namespace App\Enum;

enum RoomContent
{
    case Empty;
    case Monster;
    case Treasure;
    case Exit;
}
