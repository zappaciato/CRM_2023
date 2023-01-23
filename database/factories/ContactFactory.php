<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstNameFemale(),
            'surname' => $this->faker->firstNameFemale(),
            'position' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->numerify('############'),
            'phone_business' => $this->faker->numerify('############'),
            'notes' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
