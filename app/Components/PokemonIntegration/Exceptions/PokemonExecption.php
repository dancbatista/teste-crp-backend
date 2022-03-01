<?php

namespace App\Components\PokemonIntegration\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class PokemonException extends Exception
{
    /**
     * ExampleWeatherException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = '',
        $code = 500,
        Throwable $previous = null
    ) {
        Log::error('Pokemon Error: ' . $message);
        parent::__construct($message, $code, $previous);
    }
}
