<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'logradouro', 'bairro', 'cidade','uf',
        'cep','espaco_id'
    ];

    public function espacos(){
        return $this->hasOne(Espaco::class);
    }




}
