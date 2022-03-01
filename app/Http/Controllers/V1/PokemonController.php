<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\V1\Pokemon\PokemonServiceRegistration;
use App\Service\V1\Pokemon\PokemonServiceShow;
use App\Service\V1\Pokemon\PokemonServiceUpdate;
use App\Filters\V1\Pokemon\PokemonFilter;
use App\Service\V1\Pokemon\PokemonServiceDelete;
use App\Components\PokemonIntegration\Client as ClientAuthorization;

class PokemonController extends Controller
{
    protected $pokemonServiceRegistration;
    protected $pokemonServiceShow;
    protected $pokemonFilter;
    protected $pokemonServiceUpdate;
    protected $pokemonServiceDelete;

    public function __construct(
        PokemonServiceRegistration $pokemonServiceRegistration,
        PokemonServiceShow $pokemonServiceShow,
        PokemonFilter $pokemonFilter,
        PokemonServiceUpdate $pokemonServiceUpdate,
        PokemonServiceDelete $pokemonServiceDelete
    )
    {
        $this->pokemonServiceRegistration = $pokemonServiceRegistration;
        $this->pokemonServiceShow = $pokemonServiceShow;
        $this->pokemonFilter = $pokemonFilter;
        $this->pokemonServiceUpdate = $pokemonServiceUpdate;
        $this->pokemonServiceDelete = $pokemonServiceDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pokemon = $this->pokemonFilter->apply($request->all());
        return response()->json(['data' => $pokemon]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): object
    {
        $movie = $this->pokemonServiceRegistration->store($request);

        return response()->json(['data' => $movie]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->pokemonServiceShow->show($id);

        return response()->json(['data' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $movie = $this->pokemonServiceUpdate->update($id, $request);
        return response()->json(['data' => $movie]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = $this->pokemonServiceDelete->delete($id);
        return response()->json(['data' => $movie]);
    }

    public function showPokemonIntegration($name)
    {
        return response()->json(['data' => app(ClientAuthorization::class)->pokemon($name)]);
    }

}
