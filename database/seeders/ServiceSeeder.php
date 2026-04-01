<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'slug' => 'education',
            'name' => 'Education',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Service::create([
            'slug' => 'healthcare',
            'name' => 'Healthcare',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Service::create([
            'slug' => 'business',
            'name' => 'Business',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Service::create([
            'slug' => 'travel',
            'name' => 'Travel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Service::create([
            'slug' => 'career',
            'name' => 'Career',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
