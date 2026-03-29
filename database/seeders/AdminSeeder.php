<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'type' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Counselor',
            'email' => 'counselor@demo.com',
            'type' => 'counselor',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Receptionist',
            'email' => 'receptionist@demo.com',
            'type' => 'receptionist',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Employee',
            'email' => 'employee@demo.com',
            'type' => 'employee',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Client',
            'email' => 'client@demo.com',
            'type' => 'client',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'Agent',
            'email' => 'agent@demo.com',
            'type' => 'agent',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
    }
}
