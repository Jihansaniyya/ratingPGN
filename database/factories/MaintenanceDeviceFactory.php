<?php

namespace Database\Factories;

use App\Models\OnSiteForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceDevice>
 */
class MaintenanceDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'on_site_form_id' => OnSiteForm::factory(),
            'device_name' => $this->faker->randomElement(['Router MikroTik', 'Switch Cisco', 'ONT ZTE', 'Access Point UniFi', 'Modem Huawei']),
            'serial_number' => $this->faker->bothify('SN-####-????-####'),
            'product_photo' => null,
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
