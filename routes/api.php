<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => ''], function ($router) {

    Route::post('pokemon', 'V1\\PokemonController@store');
    Route::post('pokemon/{id}', 'V1\\PokemonController@update');
    Route::get('pokemon', 'V1\\PokemonController@index');
    Route::get('pokemon/{id}', 'V1\\PokemonController@show');
    Route::delete('pokemon/{id}', 'V1\\PokemonController@destroy');

    Route::get('pokemon-integration/{name}', 'V1\\PokemonController@showPokemonIntegration');
});
