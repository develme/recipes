<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Recipe as RecipeModel;

class Recipe
{
    /**
     * @param string|null $search
     * @param int $perPage
     * @param int $page
     * @param array{ingredient: string, author: string} $filters
     * @return LengthAwarePaginator
     */
    public function search(?string $search, int $perPage = 15, int $page = 1, array $filters = []): LengthAwarePaginator
    {
        $builder = RecipeModel::with(['ingredients', 'steps' => function ($builder) {
            $builder->orderBy('order');
        }]);

        if (!empty($search)) {
            $builder->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
                $query->orWhere('description', 'like', "%$search%");
                $query->orWhereExists(function ($query) use ($search) {
                    $query->selectRaw('1')
                        ->from('recipe_ingredients')
                        ->where('name', 'like', "%$search%")
                        ->whereColumn('recipe_id', 'recipes.id');
                });
                $query->orWhereExists(function ($query) use ($search) {
                    $query->selectRaw('1')
                        ->from('recipe_steps')
                        ->where('name', 'like', "%$search%")
                        ->whereColumn('recipe_id', 'recipes.id');
                });
            });
        }

        if (!empty($filters['ingredient'])) {
            $builder->whereExists(function ($query) use ($filters){
                $query->selectRaw('1')
                    ->from('recipe_ingredients')
                    ->where('name', '=', $filters['ingredient'])
                    ->whereColumn('recipe_id', 'recipes.id');
            });
        }

        if (!empty($filters['author'])) {
            $builder->where('email', '=', $filters['author']);
        }

        return $builder->paginate($perPage, ['*'], 'page', $page);
    }
}
