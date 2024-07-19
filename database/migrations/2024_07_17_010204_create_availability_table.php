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
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['date', 'start_time', 'end_time']); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability');
    }
}
