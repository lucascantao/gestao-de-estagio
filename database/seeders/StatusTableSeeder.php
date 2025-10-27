<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('internship_status')->insert([
            ['name' => 'Em Análise'],
            ['name' => 'Em Andamento'],
            ['name' => 'Aguardando Deferimento'],
            ['name' => 'Finalizado'],
        ]);
    }
}
