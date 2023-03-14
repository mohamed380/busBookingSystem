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
        Schema::table('stations', function (Blueprint $table) {
            $table->dropForeign(['previous_station_id']);
            $table->dropForeign(['next_station_id']);
            $table->dropColumn(['previous_station_id', 'next_station_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->unsignedBigInteger('previous_station_id')->nullable();
            $table->unsignedBigInteger('next_station_id')->nullable();
            $table->foreign('previous_station_id')->references('id')->on('stations');
            $table->foreign('next_station_id')->references('id')->on('stations');
        });
    }
};
