<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_enrollments')->insert([
            [
                'student_number' => '202304940001',
                'user_id' => 2,
                'course_id' => 1,
            ],
            [
                'student_number' => '202304940002',
                'user_id' => 3,
                'course_id' => 2,
            ],
            [
                'student_number' => '202304940003',
                'user_id' => 4,
                'course_id' => 1,
            ],
        ]);
    }
}
