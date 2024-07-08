<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'author' => $this->faker->name(),
            'translator' => $this->faker->name(),
            'publish_year' => $this->faker->year(),
            'cost' => $this->faker->randomNumber(4, true),
            'price' => $this->faker->randomNumber(4, true),
            'stock' => $this->faker->randomNumber(2, true),
        ];
    }
}
