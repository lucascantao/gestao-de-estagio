<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CoursesTableSeeder::class,
            RolesTableSeeder::class,
            StatusTableSeeder::class,
            UsersTableSeeder::class,
            EnrollmentsTableSeeder::class,
            CompanyTableSeeder::class,
            InternshipsTableSeeder::class
        ]);
    }
}
