<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        // $delivery_name = ['حمامة', 'يمامة', 'حودة'];

        return [
            'number' => '123',
            'status' => 'completed',
            'cookie_id' => $this->faker->uuid(),
            'delivery_name' => 'حمامة',
            'payment_status' => 'unpaid',
            'billing_name' => $this->faker->name(),
            'billing_country_name' => $this->faker->country(),
            'billing_address' => $this->faker->address(),
            'billing_city' => $this->faker->city(),
            'billing_state' => $this->faker->city(),
            'billing_postcode' => 555,
            'billing_email' => $this->faker->email(),
            'billing_phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
