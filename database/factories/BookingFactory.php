<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;

    public function definition()
    {
        $startTime = $this->faker->dateTimeBetween('now', '+1 week');
        $endTime = (clone $startTime)->modify('+2 hours');

        return [
            'user_id' => \App\Models\User::factory(),
            'field_id' => \App\Models\Field::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $this->faker->randomFloat(2, 20, 200),
            'status' => $this->faker->randomElement(['pending', 'paid', 'completed', 'cancelled']),
        ];
    }
}
