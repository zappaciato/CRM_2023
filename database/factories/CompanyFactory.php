<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'country' => $this->faker->countryCode(),
            'nip' => $this->faker->numerify('###'),
            'www' => $this->faker->url(),
            'notes' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
