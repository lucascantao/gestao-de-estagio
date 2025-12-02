<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Lucas Dev',
                'email'=> 'cantao162@gmail.com',
                'password'=> bcrypt('12345678'),
                'role_id' => 1,
            ],
            [
                'name' => 'John Doe',
                'email'=> 'johndoe@gmail.com',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Jane Doe',
                'email'=> 'janedoe@gmail.com',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Fulano de Tal',
                'email'=> 'fulano@gmail.com',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Ciclano de Tal',
                'email'=> 'ciclano@gmail.com',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
        ]);
    }
}
