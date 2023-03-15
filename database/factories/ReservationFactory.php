<?php

namespace Database\Factories;

use App\Models\BusSeat;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
        ];
    }

    public function trip(Trip $trip): ReservationFactory
    {
        return $this->state(function (array $attributes) use($trip){
            return [
                'trip_id' => $trip->id,
            ];
        });
    }

    public function busSeat(BusSeat $seat): ReservationFactory
    {
        return $this->state(function (array $attributes) use($seat){
            return [
                'bus_seat_id' => $seat->id,
            ];
        });
    }
}
