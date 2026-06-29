<?php

namespace App\Exception;

use RuntimeException;
use Throwable;

class UnsupportedDirectionException extends RuntimeException
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}