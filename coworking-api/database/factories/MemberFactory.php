<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Plan;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'plan_id'   => Plan::query()->inRandomOrder()->value('id') ?? Plan::factory(),
            'company'   => fake()->company(),
            'joined_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
