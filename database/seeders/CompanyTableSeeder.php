<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Tech Solutions',
                'address'=> '123 Tech Street',
                'cnpj'=> '12.345.678/0001-99',
                'phone'=> '555-1234',
                'email'=> 'RtYx4@example.com',
            ],
            [
                'name' => 'Innovatech',
                'address'=> '456 Innovation Ave',
                'cnpj'=> '98.765.432/0001-11',
                'phone'=> '555-5678',
                'email'=> 'lMmZV@example.com',
            ],
            [
                'name' => 'Digital Innovators',
                'address'=> '789 Digital Blvd',
                'cnpj'=> '12.345.678/0001-99',
                'phone'=> '555-8901',
                'email'=> 'H4dF2@example.com',
            ],
        ]);
    }
}
