<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
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
        $start = $this->faker->time('H:i');

        return [
            'user_id' => User::factory(),

            'vehicle_type' => $this->faker->randomElement([
                'Car',
                'Motorcycle',
                'Van'
            ]),

            'plate_number' => strtoupper(
                $this->faker->bothify('???-####')
            ),

            'reservation_date' => $this->faker->date(),

            'start_time' => $start,

            'end_time' => date('H:i', strtotime($start . ' +2 hours')),

            'parking_slot' => 'Slot-' . $this->faker->numberBetween(1, 20),
        ];
    }
}
