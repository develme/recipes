<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeCollection as RecipeCollectionResource;
use App\Models\Recipe;
use App\Http\Resources\Recipe as RecipeResource;
use Illuminate\Http\Request;
use App\Repository\Recipe as RecipeRepository;

class RecipeController extends Controller
{
    /**
     * @param Request $request
     * @param RecipeRepository $repository
     * @return RecipeCollectionResource
     * @response array{data: array{data: Recipe, links: array{self: string}}[], links: array{}, meta: array{}}
     */
    public function index(Request $request, RecipeRepository $repository): RecipeCollectionResource
    {
        return new RecipeCollectionResource(
            $repository->search(
                search: $request->get('keyword', ''),
                perPage: $request->get('per_page', 15),
                page: $request->get('page', 1),
                filters: $request->only(['ingredient', 'author'])
            )
        );
    }

    public function show(Recipe $recipe): RecipeResource
    {
        return new RecipeResource($recipe->load(['ingredients', 'steps' => function ($builder) {
            $builder->orderBy('order');
        }]));
    }
}
