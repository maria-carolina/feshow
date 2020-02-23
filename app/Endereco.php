<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'logradouro', 'bairro', 'cidade','uf',
        'cep','casa_id'
    ];

    public function casas(){
        return $this->hasOne(Casa::class);
    }




}
