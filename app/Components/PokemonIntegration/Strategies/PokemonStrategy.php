<?php

namespace App\Components\PokemonIntegration\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\PokemonIntegration\Contracts\PokemonInterface;
use App\Components\PokemonIntegration\Exceptions\PokemonException;;

class PokemonStrategy implements PokemonInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ExampleWeatherStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $name
     * @return Object
     * @throws Exception
     */
    public function pokemon(
        string $name
    ): Object
    {
        try {
            $response = $this->client->request('GET', 'pokemon/'.$name , [
                'json' => '',
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            throw new PokemonException(
            'Pokemon not found', $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
