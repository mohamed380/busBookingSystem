<?php

namespace Tests\Unit;

use App\Models\Bus;
use App\Models\BusSeat;
use App\Models\Reservation;
use App\Models\Station;
use App\Models\Trip;
use App\Services\ReservationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ReservationsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_it_build_and_load_station_capacity(): void
    {
        $stations = Station::newFactory()->count(5)->create();
        $bus = Bus::newFactory()->create();
        BusSeat::newFactory()->count(12)->ofBus($bus)->create();

        $stations->each(function (Station $mainStation, $key) use ($stations, $bus) {
            $stations->skip($key + 1)->each(function (Station $station, $key) use($mainStation, $bus){
              $trip = Trip::newFactory()->sourceStation($mainStation)->destinationStation($station)->bus($bus)->create();
              Reservation::newFactory()->count($this->faker->numberBetween(1, 3))->trip($trip)
                  ->busSeat($this->faker->randomElement($bus->seats))
                  ->create();

            });

        });

        $results = (new ReservationService())->tripsTrack();
    }
}
