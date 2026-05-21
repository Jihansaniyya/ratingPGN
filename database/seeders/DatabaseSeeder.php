<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@gasnet.co.id'],
            [
                'name' => 'Admin Gasnet',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create sample petugas
        User::updateOrCreate(
            ['email' => 'petugas@gasnet.co.id'],
            [
                'name' => 'Petugas Demo',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        // Create 10 dummy customers
        \App\Models\Customer::factory(10)->create()->each(function ($customer) {
            // For each customer, create 1 to 3 on-site forms
            \App\Models\OnSiteForm::factory(rand(1, 3))->create([
                'customer_cid' => $customer->cid,
                'user_id' => \App\Models\User::where('role', 'petugas')->inRandomOrder()->first()->id ?? 2,
            ])->each(function ($form) {
                // For each form, create 0 to 2 maintenance devices
                if (rand(0, 1)) {
                    \App\Models\MaintenanceDevice::factory(rand(1, 2))->create([
                        'on_site_form_id' => $form->id,
                    ]);
                }
            });
        });
    }
}
