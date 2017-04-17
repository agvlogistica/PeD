<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

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
