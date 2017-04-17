<?php

use Illuminate\Database\Seeder;

class Grupo_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupo_user')->insert([
            'user_id' => 1,
            'grupo_id' => 1,
        ]);
    }
}
