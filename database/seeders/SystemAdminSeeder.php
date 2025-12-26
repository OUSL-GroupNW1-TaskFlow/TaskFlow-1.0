<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create System Admin (DEFAULT ACCOUNT)
        $user = User::firstOrCreate(
        ['email' => 'sysadmin@taskflow.com'],
        [
            'name' => 'System Admin',
            'password' => Hash::make('admin123'),
        ]
    );

    // Assign system_admin role
    if (!$user->hasRole('system_admin')) {
        $user->assignRole('system_admin');
    }
    }
}
