<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = Recipe::factory(100)->create();

        $recipes->each(function (Recipe $recipe) {
            $recipe->ingredients()->createMany(
                RecipeIngredient::factory(5)->make(['recipe_id'  => null])->toArray()
            );
        });

        $recipes->each(function (Recipe $recipe) {
            $steps = RecipeStep::factory(5)->make(['recipe_id' => null]);

            foreach ($steps as $pos => $step) {
                $step->order = $pos + 1;
            }

            $recipe->steps()->createMany(
                $steps->toArray()
            );
        });
    }
}
