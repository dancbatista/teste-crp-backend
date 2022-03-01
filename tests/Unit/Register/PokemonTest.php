<?php

namespace Tests\Unit;
use App\Models\Pokemon;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attribute = [
            'name' => 'kojui',
            'velocity' => 23,
            'image' => null
        ];
        $pokemon = Pokemon::create($attribute);
        $expcetedPokemonId = Pokemon::find($pokemon->id);
        $this->assertEquals($expcetedPokemonId->id, $pokemon->id);
    }
}
