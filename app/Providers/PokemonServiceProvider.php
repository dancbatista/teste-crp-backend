<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\PokemonIntegration\Client;
use App\Components\PokemonIntegration\Strategies\PokemonStrategy;

class PokemonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $config = config('pokemon');
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);

            return new Client(new PokemonStrategy($client));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
