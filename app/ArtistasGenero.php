<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistasGenero extends Model
{
    public $timestamps = false;

    public $fillable = [
        'artista_id', 'genero_id'
    ];

    public function artistas(){
        return $this->hasMany(Artista::class);
    }

    public function generos(){
        return $this->hasMany(Genero::class);
    }
}
