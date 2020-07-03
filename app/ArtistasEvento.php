<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ArtistasEvento extends Model
{
    protected $primaryKey = ['artista_id', 'evento_id'];
    public $incrementing = false;

    public $fillable = [
        'artista_id', 'evento_id', 'resposta'
    ];

    protected function setKeysForSaveQuery(Builder $query){
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null){
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function artistas(){
        return $this->hasMany(Artista::class);
    }

    public function eventos(){
        return $this->hasMany(Evento::class);
    }
}
