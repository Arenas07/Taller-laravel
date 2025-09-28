<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'method'     => fake()->randomElement(['card','cash','transfer']),
            'amount'     => fake()->randomFloat(2, 50, 500),
            'status'     => fake()->randomElement(['pending','paid','failed']),
        ];
    }
}
