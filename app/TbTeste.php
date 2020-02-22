<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbTeste extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'coluna1', 'coluna2'
    ];

}
