<?php

namespace App\Components\PokemonIntegration\Contracts;

interface PokemonInterface
{

    /**
     * @param string $name
     * @return Object
     */
    public function pokemon(
        string $name
    ): Object;
}
