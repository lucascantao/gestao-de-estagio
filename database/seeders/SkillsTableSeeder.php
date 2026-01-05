<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            [
                'name' => 'Java',
                'description' => 'Linguagem de programação orientada a objetos amplamente utilizada para desenvolvimento de aplicações web, móveis e corporativas.'
            ],
            [
                'name' => 'PHP',
                'description' => 'Linguagem de script de código aberto especialmente adequada para desenvolvimento web e pode ser embutida em HTML.'
            ],
            [
                'name' => 'C++',
                'description' => 'Linguagem de programação de propósito geral que suporta programação procedural, orientada a objetos e genérica.'
            ],
            [
                'name' => 'C#',
                'description' => 'Linguagem de programação desenvolvida pela Microsoft, amplamente utilizada para desenvolvimento de aplicações Windows, web e jogos.'
            ],
            [
                'name' => 'React',
                'description' => 'Biblioteca JavaScript para construção de interfaces de usuário, especialmente para aplicações web de página única.'
            ],
            [
                'name' => 'Laravel',
                'description' => 'Framework PHP para desenvolvimento de aplicações web seguindo o padrão MVC (Model-View-Controller).'
            ],
            [
                'name' => 'Angular',
                'description' => 'Framework de aplicação web de código aberto baseado em TypeScript, mantido pelo Google.'
            ],
            [
                'name' => 'Python',
                'description' => 'Linguagem de programação de alto nível conhecida por sua legibilidade e simplicidade, amplamente utilizada em ciência de dados, aprendizado de máquina e desenvolvimento web.'
            ]
        ]);
    }
}
