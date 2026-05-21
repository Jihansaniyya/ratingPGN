<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cid' => 'CID-' . $this->faker->unique()->numberBetween(10000, 99999),
            'customer_name' => $this->faker->company(),
            'provinsi' => $this->faker->state(),
            'kota_kabupaten' => $this->faker->city(),
            'kecamatan' => $this->faker->citySuffix(),
            'kelurahan' => $this->faker->streetName(),
            'alamat_lengkap' => $this->faker->address(),
            'layanan_service' => $this->faker->randomElement(['Internet Dedicated', 'Broadband', 'VPN', 'Colocation']),
            'kapasitas_capacity' => $this->faker->randomElement(['10 Mbps', '50 Mbps', '100 Mbps', '1 Gbps']),
            'no_telp_pic' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
        ];
    }
}
