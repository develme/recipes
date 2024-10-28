import type { ApiCollectionResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";

export default defineEventHandler(async (event) => {
  const { search, author, ingredient, page } = getQuery(event) as {
    search?: string;
    author?: string;
    ingredient?: string;
    page?: number;
  };

  const results = useApiFetch<ApiCollectionResponse<Recipe[]>>("recipes", {
    method: "GET",
    query: {
      keyword: search,
      author,
      ingredient,
      per_page: 9,
      page: page || 1,
    },
  });

  return results;
});
