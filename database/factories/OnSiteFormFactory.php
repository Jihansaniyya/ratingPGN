<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OnSiteForm>
 */
class OnSiteFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_cid' => Customer::factory(),
            'user_id' => User::factory(),
            'activity_survey' => $this->faker->boolean(20),
            'activity_activation' => $this->faker->boolean(20),
            'activity_upgrade' => $this->faker->boolean(10),
            'activity_downgrade' => $this->faker->boolean(10),
            'activity_troubleshoot' => $this->faker->boolean(40),
            'activity_preventive_maintenance' => $this->faker->boolean(30),
            'complaint' => $this->faker->sentence(),
            'action' => $this->faker->paragraph(),
            'assessment' => $this->faker->randomElement(['tidak_puas', 'puas', 'sangat_puas']),
            'signature_first_party' => null,
            'signature_second_party' => null,
            'first_party_name' => $this->faker->name(),
            'second_party_name' => $this->faker->name(),
            'location' => $this->faker->city(),
            'form_date' => $this->faker->date(),
        ];
    }
}
