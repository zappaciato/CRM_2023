<?php

namespace Database\Factories;

use App\Models\Company;
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

        $compData = Company::select('id', 'name')->get();

        $randomNumber = $this->faker->unique()->numberBetween($min = 0, $max = count($compData)); // 8567

        return [
            'name' => $this->faker->firstNameFemale(),
            'surname' => $this->faker->firstNameFemale(),
            'position' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->numerify('############'),
            'phone_business' => $this->faker->numerify('############'),
            'notes' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'company_id' => $compData[$randomNumber]->id,
        ];
    }
}
