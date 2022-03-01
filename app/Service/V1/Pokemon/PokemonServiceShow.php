<?php

namespace App\Service\V1\Pokemon;

use App\Repository\V1\Pokemon\PokemonRepository;

use Validator;

class PokemonServiceShow
{

    use Traits\RuleTrait;

    protected $pokemonRepository;

    public function __construct(
        PokemonRepository $pokemonRepository
    )
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function show(int $id)
    {
        return $this->pokemonRepository->show($id);
    }

}
