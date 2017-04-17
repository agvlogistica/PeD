<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'ordem' => 1,
            'nome' => "Manutenção",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 1,
            'nome' => "Usuários",
            'rota' => "user.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 2,
            'nome' => "Grupo",
            'rota' => "grupo.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 3,
            'nome' => "Grupo X Usuário",
            'rota' => "grupo_usuario.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 4,
            'nome' => "Empresa",
            'rota' => "empresa.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 5,
            'nome' => "Menu",
            'rota' => "menu.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 6,
            'nome' => "Acesso",
            'rota' => "acesso.index",
        ]);

        DB::table('menus')->insert([
            'menu_pai_id' => 1,
            'ordem' => 7,
            'nome' => "Parâmetro",
            'rota' => "parametro.index",
        ]);

    }
}
