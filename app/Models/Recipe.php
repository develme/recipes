<?php

namespace App\Models;

use App\Models\Behaviors\WithSlugRouteBinding;
use App\Search\HasIndexableData;
use Database\Factories\RecipeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model implements HasIndexableData
{
    /** @use HasFactory<RecipeFactory> */
    use HasFactory, WithSlugRouteBinding;


    public function steps(): HasMany
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function getIndexableData(): array
    {
        $data = [
            'slug' => $this->slug,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'created_at' => $this->created_at?->format('Y-m-d\TH:i:s\Z'),
        ];

        $data['step_name'] = $this->steps->map(function (RecipeStep $step) {
            return $step->name;
        })->toArray();

        $data['ingredient_name'] = $this->ingredients->map(function (RecipeIngredient $ingredient) {
            return $ingredient->name;
        })->toArray();


        return $data;
    }
}
