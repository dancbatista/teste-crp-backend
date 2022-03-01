<?php

namespace App\Service\V1\Pokemon;

use App\Repository\V1\Pokemon\PokemonRepository;

use Validator;

class PokemonServiceDelete
{

    use Traits\RuleTrait;

    protected $pokemonRepository;

    public function __construct(
        PokemonRepository $pokemonRepository
    )
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function delete(int $id) {

        if (!get_object_vars(($this->pokemonRepository->show($id)))) {
            return "pokemon not found";
        }

        $pokemon = $this->pokemonRepository->delete($id);

        return $pokemon ?? "pokemon invalid";
    }

}
