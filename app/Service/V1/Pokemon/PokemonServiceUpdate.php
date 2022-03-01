<?php

namespace App\Service\V1\Pokemon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repository\V1\Pokemon\PokemonRepository;

use Validator;

class PokemonServiceUpdate
{

    use Traits\RuleTrait;

    protected $pokemonRepository;

    public function __construct(
        PokemonRepository $pokemonRepository
    )
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();

         $validator = Validator::make($attributes, $this->rules($id));


        if ($validator->fails()) {
            return $validator->errors();
        }

        if ($request->hasFile('image')) {
            if(!get_object_vars(($this->pokemonRepository->show($id)))) {
                return "pokemon invalid";
            }

            $image = $this->uploadImg($request->file('image'), $id);
        }

        $attributes['image']= empty($image)?null:$image;

         return $this->pokemonRepository->update($id, $attributes);
    }

    public function uploadImg($file, $id)
    {
        if ($this->pokemonRepository->show($id)) {
            Storage::delete('public' . $this->pokemonRepository->show($id)->image);
        }

        return  $file->store('archive', 'public');
    }
}
