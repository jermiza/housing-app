<?php

namespace Database\Factories;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statement>
 */
class StatementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'desc' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(1, 20),
            'active' => $this->faker->boolean(),
            'address' => $this->faker->city(),
            'floors' => $this->faker->numberBetween(1, 20),
            'user_id' => User::first()->id,
            'property_type_id' => PropertyType::first()->id,
        ];
    }
}
