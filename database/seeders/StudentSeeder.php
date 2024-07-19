<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Clear the table before seeding
        DB::table('students')->truncate();

        // Seed new data
        DB::table('students')->insert([
            [
                'lastname' => 'Doe',
                'firstname' => 'John',
                'middlename' => 'A.',
                'student_id' => 'SID1234',
                'course' => 'Computer Science',
                'year_section' => 'A1',
            ],
            [
                'lastname' => 'Smith',
                'firstname' => 'Jane',
                'middlename' => 'B.',
                'student_id' => 'SID1235',
                'course' => 'Information Technology',
                'year_section' => 'B1',
            ],
        ]);
    }
}
