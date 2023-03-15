<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_station_id' => Station::factory()->create()->id,
            'destination_station_id' => Station::factory()->create()->id,
            'bus_id' => Bus::factory()->create()->id,
            'main_trip_id' => null,
        ];
    }

    public function sourceStation(Station $station): TripFactory
    {
        return $this->state(function (array $attributes) use($station){
            return [
                'source_station_id' => $station->id,
            ];
        });
    }

    public function destinationStation(Station $station): TripFactory
    {
        return $this->state(function (array $attributes) use($station){
            return [
                'destination_station_id' => $station->id,
            ];
        });
    }


    public function bus(Bus $bus): TripFactory
    {
        return $this->state(function (array $attributes) use($bus){
            return [
                'bus_id' => $bus->id,
            ];
        });
    }
}
