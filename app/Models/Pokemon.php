<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = "pokemons";

    protected $fillable = [
        'name', 'velocity', 'image'
    ];
    protected $visible = [
        'id', 'name', 'velocity', 'image'
    ];

}
