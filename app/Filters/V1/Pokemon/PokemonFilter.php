<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovieFilters
 *
 * @author daniel batista
 */

namespace App\Filters\V1\Pokemon;

use App\Service\V1\Pokemon\PokemonServiceAll;

class PokemonFilter
{

    private $searchQuery;
    private $pokemonServiceAll;

    public function __construct(
        PokemonServiceAll $pokemonServiceAll
    )
    {
        $this->pokemonServiceAll = $pokemonServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->pokemonServiceAll->all($this->searchQuery);
    }

}
