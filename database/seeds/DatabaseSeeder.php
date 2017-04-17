<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GruposTableSeeder::class);
        $this->call(Grupo_UserTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(AcessosTableSeeder::class);
    }
}
