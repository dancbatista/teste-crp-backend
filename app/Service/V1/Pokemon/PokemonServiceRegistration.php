<?php

namespace App\Service\V1\Pokemon;

use App\Repository\V1\Pokemon\PokemonRepository;

use Validator;

class PokemonServiceRegistration
{

    use Traits\RuleTrait;

    protected $pokemonRepository;

    public function __construct(
        PokemonRepository $pokemonRepository
    )
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

         $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
             return $validator->errors();
        }

        if (!empty($attributes['image']) && $request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'));
        }

        $attributes['image'] = empty($image) ? null : $image;
        $pokemon = $this->pokemonRepository->save($attributes);
        return $pokemon ?? 'unidentified pokemon';
    }

    public function uploadImg($file) {
        return $file->store('archive','public');
    }

}
