<?php

namespace App\Service\V1\Pokemon;

use App\Repository\V1\Pokemon\PokemonRepository;

use Validator;

class PokemonServiceAll
{

    use Traits\RuleTrait;

    protected $pokemonRepository;

    public function __construct(
        PokemonRepository $pokemonRepository
    )
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->pokemonRepository->all($searchQuery);
    }

}
