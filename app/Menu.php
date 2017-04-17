<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ordem', 'nome', 'rota',
    ];

    public function menus()
    {
        return $this->hasMany('App\Menu', 'menu_pai_id');
    }

    public function menu_pai()
    {
        return $this->belongsTo('App\Menu');
    }

    public function acessos()
    {
        return $this->hasMany('App\Acessos');
    }

}
