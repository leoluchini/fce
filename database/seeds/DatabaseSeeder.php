<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        //$this->call(PaisesTableSeeder::class);
        //$this->call(ProvinciasTableSeeder::class);
        //$this->call(CategoriasTableSeeder::class);
        //$this->call(PublicacionesTableSeeder::class);
        $this->call(FrecuenciasTableSeeder::class);
    }
}
