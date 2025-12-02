<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InternshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('internships')->insert([
            [
                'workload' => 20,
                'schedule'=> 'Manhã',
                'start_date'=> '2025-01-15',
                'end_date'=> '2025-07-15',
                'salary'=> 1500.00,
                'observation'=> 'First internship',
                'supervisor'=> 'Alice Smith',
                'internship_status_id' => 1,
                'company_id' => 1,
                'user_id' => 2,
            ],
            [
                'workload' => 30,
                'schedule'=> 'Tarde',
                'start_date'=> '2025-02-01',
                'end_date'=> '2025-08-01',
                'salary'=> 1200.00,
                'observation'=> 'Second internship',
                'supervisor'=> 'Bob Johnson',
                'internship_status_id' => 2,
                'company_id' => 2,
                'user_id' => 3,
            ],

        ]);
    }
}
