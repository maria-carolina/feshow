<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    public $timestamps = false;

    public $fillable = [
        'artista_id',
        'espaco_id',
        'data',
        'resposta'
    ];

}
