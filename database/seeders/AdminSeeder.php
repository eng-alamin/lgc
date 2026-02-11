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
        // $admin = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@demo.com',
        //     'type' => 'admin',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'),
        //     ])->assignRole('admin');
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'type' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            ]);
    }
}
