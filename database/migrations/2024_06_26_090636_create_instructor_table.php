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
            $table->string('instructor_lastname');
            $table->string('instructor_firstname');
            $table->string('instructor_middlename')->nullable();
            $table->string('instructor_id')->unique();
            $table->string('voice_recording')->nullable(); // Store file path as a string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_instructors');
    }
};
