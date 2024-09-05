<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointment')->truncate();

        DB::table('appointment')->insert([
            [
                'student_id' => 'S123456',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'middlename' => 'M',
                'course' => 'Computer Science',
                'year_section' => '3-A',
                'start_time' => '10:00',
                'end_time' => '12:00',
                'appointment_date' => '2024-07-23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'S234567',
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'middlename' => 'A',
                'course' => 'Information Technology',
                'year_section' => '2-B',
                'start_time' => '09:00',
                'end_time' => '11:00',
                'appointment_date' => '2024-07-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
