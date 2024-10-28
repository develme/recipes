import type { ApiResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";

export default defineEventHandler(async (event) => {
  const slug = getRouterParam(event, "slug");

  const results = useApiFetch<ApiResponse<Recipe>>(`recipes/${slug}`);

  return results;
});
