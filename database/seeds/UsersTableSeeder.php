<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "youssef",
            'email' => "yn-neinaa@hotmail.com",
            'password' => bcrypt(123456),
            'phone' => "0762927783",
        ]);

        $user->attachRole('super_admin');
    }
}
