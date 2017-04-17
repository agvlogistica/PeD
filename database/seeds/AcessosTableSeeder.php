<?php

use Illuminate\Database\Seeder;

class AcessosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acessos')->insert([
            'menu_id' => 1,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 2,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 3,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 4,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 5,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 6,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 7,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);

        DB::table('acessos')->insert([
            'menu_id' => 8,
            'empresa_id' => 1,
            'grupo_id' => 1,
        ]);


    }
}
