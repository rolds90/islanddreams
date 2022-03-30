<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCruiseItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruise_itineraries', function (Blueprint $table) {
            $table->foreignId('cruise_id')->constrained('cruises')->cascadeOnDelete();
            $table->integer('day');
            $table->string('location');
            $table->timestamp('itinerary_date');
            $table->timestamp('depart_at');
            $table->timestamp('arrive_at');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cruise_itineraries');
    }
}
