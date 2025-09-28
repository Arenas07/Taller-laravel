<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_id'  => Payment::factory(),
            'number'      => strtoupper(fake()->bothify('INV-####-????')),
            'issued_date' => fake()->date(),
            'meta'        => [
                'razon_social' => fake()->company(),
                'nit'          => fake()->numerify('#########'),
            ],
        ];
    }
}
