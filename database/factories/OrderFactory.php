<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company' => ucfirst($this->faker->word(2)),
            'title' => $this->faker->sentence(2),
            'date' => $this->faker->date(),
            'status' => 'new',
        ];
    }
}
