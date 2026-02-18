<?php

namespace Database\Seeders;

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
            [
                'name' => 'Em Análise',
                'description' => 'Estágio em processo de análise.',
                'text_color' => '#000000',
                'background_color' => '#FFA500'
            ],
            [
                'name' => 'Em Andamento',
                'description' => 'Estágio atualmente em andamento.',
                'text_color' => '#FFFFFF',
                'background_color' => '#007BFF'
            ],
            [
                'name' => 'Avaliando Documentação',
                'description' => 'Estágio em processo de avaliação da documentação.',
                'text_color' => '#000000',
                'background_color' => '#fff4b4'
            ],
            [
                'name' => 'Finalizado',
                'description' => 'Estágio finalizado.',
                'text_color' => '#FFFFFF',
                'background_color' => '#28A745'
            ],
        ]);
    }
}
