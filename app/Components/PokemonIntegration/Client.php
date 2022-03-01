<?php
namespace App\Components\PokemonIntegration;
use Exception;
use App\Components\PokemonIntegration\Contracts\PokemonInterface;
use App\Components\PokemonIntegration\Exceptions\PokemonException;

class Client
{
    /**
     * @var $pokemonInterface
     */
    protected $pokemonInterface;

    /**
     * Client constructor.
     * @param PokemonInterface $pokemonInterface
     */
    public function __construct(PokemonInterface $pokemonInterface)
    {
        $this->pokemonInterface = $pokemonInterface;
    }

    /**
     * @param string $name
     * @return Object
     * @throws PokemonException
     */
    public function pokemon(
        string $name
    ): Object {
        try {
            return $this->pokemonInterface->pokemon(
                $name
            );
        } catch (Exception $exception) {
            throw new PokemonException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
