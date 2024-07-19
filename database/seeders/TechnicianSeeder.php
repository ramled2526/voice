<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reg_technician')->truncate();

        DB::table('reg_technician')->insert([
            [ 
                'lastname' => 'Doe',
                'firstname' => 'John',
                'middlename' => 'A',
                'technician_id' => 'john.doe',
                'voice_recording' => 'voice_recordings/john_doe.webm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lastname' => 'Smith',
                'firstname' => 'Jane',
                'middlename' => 'B',
                'technician_id' => 'jane.smith',
                'voice_recording' => 'voice_recordings/jane_smith.webm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
