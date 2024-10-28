<?php
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::name('recipe.list')->get('/recipes', [RecipeController::class, 'index']);

Route::name('recipe.show')->get('/recipes/{recipe}', [RecipeController::class, 'show']);
