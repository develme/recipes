<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BigDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $iterations = 10000;

        $bar = $this->command->getOutput()->createProgressBar($iterations);

        for ($i = 0; $i < $iterations; $i++) {
            $this->call([
                RecipeSeeder::class,
            ]);

            $bar->advance();
        }

        
    }
}
