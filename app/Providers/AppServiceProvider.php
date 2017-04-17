<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Using Closure based composers...
        View::composer('*', function ($view) {

            $menu_lateral = null;
            $select_empresas = null;
            $css_template = null;

            if (Auth::check()) {
                $menu_lateral = $this->montaMenu();
                $select_empresas = $this->carrega_empresas();

                If (Auth::user()->empresa) {
                    $css_template = Auth::user()->empresa->css_template;
                }
            }

            $view->with(compact('menu_lateral', 'select_empresas', 'css_template'));
        });
    }

    private function montaMenu($menu_id = null, $level = 'second')
    {
        $retorno = "";

        $menus = \App\Menu::where('menu_pai_id', $menu_id)->get();

        foreach ($menus as $menu) {

            // Verifica acesso
            if ($this->verificaAcesso($menu, Auth::user()->id, Auth::user()->empresa_id)) {
                $retorno .= "<li>";

                $nome = $menu->nome;

                if ($nome[0] == '@') {
                    $nome = str_replace('@', '', $nome);
                    $nome = trans($nome);
                }

                if (!$menu->rota) {
                    $retorno .= '<a href="#"><i class="fa fa-folder"></i> <span class="">' . $nome . ' </span><span class="fa arrow"></span></a>';
                    $retorno .= '<ul class="nav nav-' . $level . '-level collapse">';
                    $retorno .= $this->montaMenu($menu->id, 'third');
                    $retorno .= '</ul>';
                } else {
                    $retorno .= '<a href="' . route($menu->rota) . '"><i class="fa fa-file"></i> ' . $nome . ' </a>';
                }
                $retorno .= '</li>';
            }

        }

        return $retorno;
    }

    private function verificaAcesso(\App\Menu $menu, $user_id, $empresa_id)
    {

        // Verifica se o usuário possuí acesso
        $acesso = \App\Acesso::where([
            ['menu_id', $menu->id],
            ['user_id', $user_id],
            ['empresa_id', $empresa_id],
        ])->get();

        if (count($acesso) > 0) return true;

        // Verifica os grupos do usuário
        foreach (Auth::user()->grupos as $grupo) {
            $acesso = \App\Acesso::where([
                ['menu_id', $menu->id],
                ['grupo_id', $grupo->id],
                ['empresa_id', $empresa_id],
            ])->get();

            if (count($acesso) > 0) return true;
        }


        return false;
    }

    private function carrega_empresas()
    {
        return DB::select('SELECT
                      empresas.id,
                      empresas.nome
                    FROM acessos
                    INNER JOIN empresas
                    ON empresas.id = acessos.empresa_id
                    INNER JOIN grupos
                    ON grupos.id = acessos.grupo_id
                    INNER JOIN grupo_user
                    ON grupo_user.grupo_id = grupos.id
                    AND grupo_user.user_id = ?
                    GROUP BY empresas.id, empresas.nome
                    UNION ALL
                    SELECT
                      empresas.id,
                      empresas.nome
                    FROM acessos
                    INNER JOIN empresas
                    ON empresas.id = acessos.empresa_id
                    INNER JOIN users
                    ON users.id = acessos.user_id
                    AND users.id = ?
                    GROUP BY empresas.id, empresas.nome
        ', [Auth::user()->id, Auth::user()->id]);
    }
}
