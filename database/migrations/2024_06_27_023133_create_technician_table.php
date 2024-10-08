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
        Schema::create('reg_technician', function (Blueprint $table) {
            $table->id();
            $table->string('technician_lastname');
            $table->string('technician_firstname');
            $table->string('technician_middlename')->nullable();
            $table->string('technician_id');
            $table->string('voice_recording');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_technician');
    }
};
