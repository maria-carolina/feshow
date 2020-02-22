<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'nome', 'telefone'
    ];

    public function enderecos(){
        return $this->belongsTo('enderecos');
    }

    public function generos(){
        return $this->hasMany('generos');
    }
}
