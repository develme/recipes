import { ApiResponse } from "~/types/api";
import { Recipe } from "~/types/recipe";

export default defineEventHandler(async (event) => {
  const slug = getRouterParam(event, "slug");

  const results = useApiFetch<ApiResponse<Recipe>>(`recipes/${slug}`);

  return results;
});
