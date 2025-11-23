<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent' => null, // Or use `Page::factory()` for hierarchy
            'title' => $this->faker->sentence(3),
            'alias' => Str::slug($this->faker->unique()->sentence(3)),
            'status' => $this->faker->randomElement([ 1]), // Active or Inactive
            'display_order' => $this->faker->optional()->numberBetween(1, 100),
            'createdby' => $this->faker->name(),
            'created_at' => now(),
            'updatedby' => $this->faker->name(),
            'updated_at' => now(),
        ];
    }
}
