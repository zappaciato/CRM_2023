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
            
            'company_id',
            'email_id',
            'contact_person',
            'address',
            'lead_person',
            'involved_person',
            'priority',
            'order_content',
            'order_notes',
            
            'date',
            'status', 
            'company_id',
        ];
    }
}
