<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Adldap\Laravel\Traits\AdldapUserModelTrait;

class User extends Authenticatable
{
    use AdldapUserModelTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    public function grupos()
    {
        return $this->belongsToMany('App\Grupo');
    }

    public function acessos()
    {
        return $this->hasMany('App\Acesso');
    }

    public function parametros()
    {
        return $this->hasMany('App\Parametro');
    }

    public function busca_parametros($controle, $tipo)
    {
        $filtro = [
            ['empresa_id', $this->empresa_id],
            ['controle', $controle],
            ['tipo', $tipo]
        ];

        $parametros = $this->parametros()->where($filtro)->get();

        foreach ($this->grupos as $grupo) {

            $parametros->push($grupo->parametros()->where($filtro)->get());
        }

        return $parametros->flatten();
    }
}
