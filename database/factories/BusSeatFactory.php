<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusSeat>
 */
class BusSeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'bus_id' => Bus::factory()->create()->id
        ];
    }

    public function ofBus(Bus $bus): BusSeatFactory
    {
        return $this->state(function (array $attributes) use($bus){
            return [
                'bus_id' => $bus->id,
            ];
        });
    }
}
