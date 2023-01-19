<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'sender' => $this->faker->name($gender = 'male' | 'female'),
            'email' => $this->faker->companyEmail(),
            'title' => $this->faker->sentence(2),
            'content' => $this->faker->sentence(30),
            'date'=> $this->faker->date(),
            'emailstatus' => 'read',
        ];
    }
}
