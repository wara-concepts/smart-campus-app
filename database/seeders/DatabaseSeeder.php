<?php

namespace Database\Seeders;

use App\Models\department;
use App\Models\Resource;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Sample User',
            'email' => 'sample@smartcampus.com',
            'password' => 'sample'
        ]);

        Resource::factory()->create([
            "id" => 0,
            "department_id" => 0,
            "name" => "Sample Resource",
            "qty" => 10,
            "created_at" => now(),
            "updated_at"=> now(),
        ]);

        department::factory()->create([
            "id" => 0,
            "department" => "Sample Department",
            "created_at" => now(),
            "updated_at"=> now(),
        ]);
    }
}
