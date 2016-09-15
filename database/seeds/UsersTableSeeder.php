<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create(['name' => "Administrador", 'email' => 'admin@email.com', 'password' => '123456' ]);
      $user->attachRole(1);
    }
}
