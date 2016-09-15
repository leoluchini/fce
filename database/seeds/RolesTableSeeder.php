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
			]);
    }
}
