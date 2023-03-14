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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_station_id');
            $table->unsignedBigInteger('destination_station_id');
            $table->unsignedBigInteger('bus_id');
            $table->timestamps();

            $table->foreign('source_station_id')->references('id')->on('stations');
            $table->foreign('destination_station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
