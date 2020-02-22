<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'id','nome'
    ];

    public function artista(){
        return $this->belongsTo(Artista::class);
    }
}
