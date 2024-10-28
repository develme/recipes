<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    public const FOOD_TYPES = [
        'Breakfast',
        'Lunch',
        'Dinner',
        'Snack',
        'Dessert',
        'Soup',
        'Salad',
        'Appetizer',
        'Pasta',
        'Bread',
        'Drink',
        'Curry',
        'Stew',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::title(fake()->words(fake()->numberBetween(2, 5), true) . ' ' . fake()->randomElement(self::FOOD_TYPES));
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'email' => fake()->safeEmail(),
        ];
    }
}
