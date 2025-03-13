<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'id' => Str::uuid()->toString(), // Unique identifier generated as a UUID.
                'department' => $this->faker->word, // Random word for the department.
                'created_at' => now(), // Current timestamp.
                'updated_at' => now(), // Current timestamp.
        ];
    }
}
