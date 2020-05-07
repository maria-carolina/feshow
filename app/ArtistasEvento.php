<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistasEvento extends Model
{
    public $timestamps = false;

    public $fillable = [
        'artista_id', 'evento_id'
    ];

    public function artistas(){
        return $this->hasMany(Artista::class);
    }

    public function eventos(){
        return $this->hasMany(Evento::class);
    }
}
