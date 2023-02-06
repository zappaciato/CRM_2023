<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyAddress>
 */
class CompanyAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $compData = Company::select('id', 'name')->get();
// Log::debug($companyIds);
// Log::debug(count($companyIds));
// Log::debug($companyIds[0]->id);
$randomNumber = $this->faker->unique()->numberBetween($min = 0, $max = count($compData)-1); // 8567
Log::debug($randomNumber);
        return [
            'name' => 'Adres firmy: ' . $compData[$randomNumber]->name,      
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->sentence(2),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'province' => $this->faker->state(),
            'notes' => $this->faker->sentence(4),
            'company_id' => $compData[$randomNumber]->id,
        ];
    }
}
