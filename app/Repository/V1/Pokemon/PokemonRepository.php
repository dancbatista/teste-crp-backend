<?php

namespace App\Repository\V1\Pokemon;

use App\Models\Pokemon;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class PokemonRepository extends BaseRepository
{

    public function __construct(Pokemon $pokemon)
    {
        parent::__construct($pokemon);
    }
    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->paginate(15);
        }

        return $this->obj
            ->paginate(15);
    }
    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $pokemon = $this->obj->create($attributes);
            DB::commit();
            return $pokemon->where('id', $pokemon->id)
                   ->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $pokemon = $this->obj->find($id);
            if ($pokemon) {
                $pokemon = $pokemon->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return (object) $pokemon
                            ->where('id', $pokemon->id)
                            ->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->where('id', $id)
                        ->first();
    }

    public function delete($id): bool
    {
        return $this->obj->destroy($id);
    }

}
