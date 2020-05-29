<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $timestamps = false;

    public $fillable = [
        'id','nome','descricao','hora_inicio',
        'hora_fim','data','espaco_id'
    ];

    public function espaco(){
        return $this->belongsTo(Espaco::class);
    }
}
