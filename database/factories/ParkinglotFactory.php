<?php

namespace Database\Factories;

use App\Models\ParkingLot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ParkingLot>
 */
class ParkinglotFactory extends Factory
{
    protected $model = ParkingLot::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Parking Lot',
            'capacity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
