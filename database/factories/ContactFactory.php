<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

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
    public function definition(): array
    {
        $fullName = $this->faker->name();
        $email = strtolower(str_replace(' ', '.', $fullName)) . '@example.com';

        return [
            'full_name' => $fullName,
            'email' => $email,
            'company_id' => Company::factory(),
        ];
    }
}
