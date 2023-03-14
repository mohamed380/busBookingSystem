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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('previous_station_id')->nullable();
            $table->unsignedBigInteger('next_station_id')->nullable();
            $table->timestamps();
        });

        Schema::table('stations', function (Blueprint $table) {
            $table->foreign('previous_station_id')->references('id')->on('stations');
            $table->foreign('next_station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
