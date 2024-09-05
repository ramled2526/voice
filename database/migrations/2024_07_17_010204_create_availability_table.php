<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilityTable extends Migration
{
    public function up()
    {
        Schema::create('availability', function (Blueprint $table) {
            $table->id();
            $table->date('availability_date'); 
            $table->string('available_time'); 
            $table->time('start_time')->nullable(); 
            $table->time('end_time')->nullable(); 
            $table->string('status');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability');
    }
}
