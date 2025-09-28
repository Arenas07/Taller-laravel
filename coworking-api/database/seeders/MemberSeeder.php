<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\User;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = Plan::all();

        User::factory()
            ->count(rand(5,10))
            ->create()
            ->each(function ($user) use ($plans) {
                Member::create([
                    'user_id'   => $user->id,
                    'plan_id'   => $plans->random()->id,
                    'company'   => fake()->company(),
                    'joined_at' => now()->subDays(rand(10, 200)),
                ]);
            });
    }
}
