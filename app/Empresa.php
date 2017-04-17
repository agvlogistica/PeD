<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nome', 'css_template'];

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }

    public function parametros()
    {
        return $this->hasMany('App\Parametro');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
