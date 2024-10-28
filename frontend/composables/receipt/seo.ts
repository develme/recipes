import type { Recipe } from "~/types/recipe";

export const useRecipeSeoDescription = (recipe: Recipe) => {
  let description = recipe.description as string;

  if (recipe.ingredients) {
    description += ` Ingredients: ${recipe.ingredients
      .map((ingredient) => ingredient.name)
      .join(", ")}`;
  }

  if (recipe.steps) {
    description += ` Steps: ${recipe.steps
      .map((step) => step.description)
      .join(", ")}`;
  }

  return description;
};
