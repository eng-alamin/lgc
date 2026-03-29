<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stage::create([
            'type' => 'lead',
            'name' => 'Lead',
            'icon' => '<i class="bi bi-chat-text text-primary"></i>',
            'order' => '1',
            'progress_percent' => '10',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'invoice',
            'name' => 'invoices',
            'icon' => '<i class="bi bi-folder2-open text-success"></i>',
            'order' => '2',
            'progress_percent' => '30',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'documentation',
            'name' => 'Documentation',
            'icon' => '<i class="bi bi-file-earmark-pdf text-danger"></i>',
            'order' => '3',
            'progress_percent' => '50',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'application',
            'name' => 'Application Submitted',
            'icon' => '<i class="bi bi-send text-info"></i>',
            'order' => '4',
            'progress_percent' => '70',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'visa',
            'name' => 'Visa Status',
            'icon' => '<i class="bi bi-passport text-warning"></i>',
            'order' => '5',
            'progress_percent' => '80',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'flight',
            'name' => 'Flight Details',
            'icon' => '<i class="bi bi-airplane text-primary"></i>',
            'order' => '6',
            'progress_percent' => '90',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Stage::create([
            'type' => 'mission',
            'name' => 'Mission Accomplished',
            'icon' => '<i class="bi bi-check-circle text-success"></i>',
            'order' => '7',
            'progress_percent' => '100',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
