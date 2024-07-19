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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('student_id')->unique();
            $table->string('course');
            $table->string('year_section');
            $table->timestamps();
        });
    }
        
        public function down()
        {
            Schema::dropIfExists('students');
        }
    
}; 
