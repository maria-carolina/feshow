<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espaco extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'id',
        'nome',
        'telefone',
        'descricao',
        'user_id'
    ];

    public function enderecos(){
        return $this->belongsTo('enderecos');
    }

    public function generos(){
        return $this->hasMany('generos');
    }
}
