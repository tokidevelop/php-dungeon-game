<?php

declare(strict_types=1);

namespace App\Result;

final readonly class CombatResult
{
    public function __construct(
        private string $message,
    ) {
    }

    public function message(): string
    {
        return $this->message;
    }
}
