<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Demo Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@taskflow.com'],
            [
                'name' => 'Demo Admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        // Demo Agent
        $agent = User::firstOrCreate(
            ['email' => 'agent@taskflow.com'],
            [
                'name' => 'Demo Agent',
                'password' => Hash::make('agent123'),
            ]
        );
        $agent->assignRole('agent');
    }
}
