<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
use App\Models\Room;
use Carbon\Carbon;
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
    public function definition(): array {
        $start = Carbon::now()->addDays(rand(1,10))->setTime(rand(8,18), 0);
        $end   = (clone $start)->addHours(rand(1,3));

        return [
            'member_id' => Member::factory(),
            'room_id'   => Room::factory(),
            'start_at'  => $start,
            'end_at'    => $end,
            'status'    => fake()->randomElement(['pending','confirmed','cancelled']),
            'purpose'   => fake()->sentence(3),
        ];
    }
}
