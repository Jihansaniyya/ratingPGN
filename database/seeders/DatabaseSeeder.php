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
        User::create([
            'name' => 'Admin Gasnet',
            'email' => 'admin@gasnet.co.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create sample petugas
        User::create([
            'name' => 'Petugas Demo',
            'email' => 'petugas@gasnet.co.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);
    }
}
