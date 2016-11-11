<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'level' => 3,
        ]);

        $userRole = Role::create([
            'name' => 'Usuario',
            'slug' => 'user',
            'level' => 2,
        ]);

    	$loadRole = Role::create([
    	    'name' => 'Cargar Datos',
    	    'slug' => 'load_data',
            'level' => 1,
    	]);
    }
}
