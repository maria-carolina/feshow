<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{

    public $timestamps = false;

    public $fillable = [
        'id','nome', 'email', 'quantidade_membros', 'telefone', 'cep',
        'cidade', 'link', 'genero_id', 'user_id'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function genero(){
            return $this->hasOne(Genero::class);
    }

    public function evento(){
        return $this->hasMany(Evento::class);
    }
}
