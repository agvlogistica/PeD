<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = ['nome'];

    public function acessos()
    {
        return $this->hasMany('App\Acesso');
    }

    public function parametros()
    {
        return $this->hasMany('App\Parametro');
    }

    public function users()
    {
        return $this->belongsToMany('App\Grupo');
    }
}
