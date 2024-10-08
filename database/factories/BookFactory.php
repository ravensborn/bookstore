<?php

namespace Database\Factories;

use App\Models\Category;
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
            'barcode' => $this->faker->randomNumber(7, true),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'category_id' => $this->faker->randomElement(Category::all()->pluck('id')),
            'author' => $this->faker->name(),
            'translator' => $this->faker->name(),
            'publish_year' => $this->faker->year(),
            'cost' => $this->faker->randomNumber(4, true),
            'price' => $this->faker->randomNumber(4, true),
            'stock' => $this->faker->randomNumber(2, true),
        ];
    }
}
