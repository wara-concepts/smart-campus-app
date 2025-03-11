<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resource::factory()->create([
            "id" => 1,
            "department_id" => 2,
            "name" => "Resource Name",
            "qty" => 2,
            "created_at" => now(),
            "updated_at"=> now(),
        ]);
    }
}
