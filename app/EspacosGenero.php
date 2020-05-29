<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspacosGenero extends Model
{
    public $timestamps = false;

    public $fillable = [
        'espaco_id', 'genero_id'
    ];

    public function casas(){
        return $this->hasMany(Casa::class);
    }

    public function genero(){
        return $this->hasMany(Genero::class);
    }
}
