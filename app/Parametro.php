<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $fillable = ['controle', 'tipo', 'item', 'parametro', 'ativo'];

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }
}
