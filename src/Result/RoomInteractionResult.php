<?php

declare(strict_types=1);

namespace App\Result;

final readonly class RoomInteractionResult
{
    private function __construct(
        private string $message,
        private bool $gameFinished = false,
    ) {
    }

    public static function continue(string $message): self
    {
        return new self($message);
    }

    public static function finish(string $message): self
    {
        return new self($message, true);
    }

    public function message(): string
    {
        return $this->message;
    }

    public function gameFinished(): bool
    {
        return $this->gameFinished;
    }
}
