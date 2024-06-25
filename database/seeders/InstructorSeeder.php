<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{ 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reg_instructors')->truncate();

        DB::table('reg_instructors')->insert([
            [ 
                'lastname' => 'Doe',
                'firstname' => 'John',
                'middlename' => 'A',
                'instructor_id' => 'john.doe',
                'voice_recording_path' => 'voice_recordings/john_doe.webm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lastname' => 'Smith',
                'firstname' => 'Jane',
                'middlename' => 'B',
                'instructor_id' => 'jane.smith',
                'voice_recording_path' => 'voice_recordings/jane_smith.webm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
