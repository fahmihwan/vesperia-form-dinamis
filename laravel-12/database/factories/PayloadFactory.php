<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payload>
 */
class PayloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "label" => $this->faker->randomElement(['judul A', 'judul B', 'judul C']),
            // 'type' => 'text'
        ];
    }
}
