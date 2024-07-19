<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reg_instructors', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('instructor_id');
            $table->string('voice_recording');
            $table->timestamps();
        });
    }
        
        public function down()
        {
            Schema::dropIfExists('reg_instructors');
        }
       
}; 
