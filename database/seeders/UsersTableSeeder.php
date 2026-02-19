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
                'phone'=> '(91) 996350528',
                'address'=> 'Pass Tupy, 11',
                'birthdate'=> '2000-10-22',
                'gender'=> 'Masculino',
                'password'=> bcrypt('12345678'),
                'role_id' => 1,
            ],
            [
                'name' => 'Admin Dev',
                'email'=> 'admindev@gmail.com',
                'phone'=> '(91) 996345678',
                'address'=> 'Pass Tupy, 11',
                'birthdate'=> '2000-10-22',
                'gender'=> 'Masculino',
                'password'=> bcrypt('admindev'),
                'role_id' => 1,
            ],
            [
                'name' => 'John Doe',
                'email'=> 'johndoe@gmail.com',
                'phone'=> '1234567890',
                'address'=> '123 Main St, Cityville',
                'birthdate'=> '1990-01-01',
                'gender'=> 'Masculino',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Jane Doe',
                'email'=> 'janedoe@gmail.com',
                'phone'=> '9876543210',
                'address'=> '456 Elm St, Townsville',
                'birthdate'=> '1995-05-05',
                'gender'=> 'feminino',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Fulano de Tal',
                'email'=> 'fulano@gmail.com',
                'phone'=> '1234567890',
                'address'=> '123 Main St, Cityville',
                'birthdate'=> '1990-01-01',
                'gender'=> 'Masculino',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'name' => 'Ciclana de Tal',
                'email'=> 'ciclano@gmail.com',
                'phone'=> '0987654321',
                'address'=> '456 Oak St, Villagetown',
                'birthdate'=> '1992-02-02',
                'gender'=> 'feminino',
                'password'=> bcrypt('12345678'),
                'role_id' => 2,
            ],
        ]);
    }
}
