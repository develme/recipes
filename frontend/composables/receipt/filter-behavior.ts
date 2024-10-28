import type { LocationQueryValue, Router } from "vue-router";
import { refDebounced } from "@vueuse/core";

export const useFilterBehavior = (
  $router: Router,
  filters: LocationQueryValue | LocationQueryValue[],
) => {
  const search = ref<string>();
  const author = ref<string>();
  const ingredient = ref<string>();
  const page = ref<number>(1);

  if (filters) {
    const parsed = JSON.parse(useBaseDecode(filters as string));
    search.value = parsed.search;
    author.value = parsed.author;
    ingredient.value = parsed.ingredient;
    page.value = parsed.page;
  }
  const searchDebounced = refDebounced(search, 300);

  watch([searchDebounced, author, ingredient, page], () => {
    const filters = {
      search: searchDebounced.value,
      author: author.value,
      ingredient: ingredient.value,
      page: page.value === 1 ? undefined : page.value,
    };

    // if they are all empty, remove the query
    if (Object.values(filters).every((v) => !v)) {
      $router.replace({ query: {} });
    } else {
      $router.replace({
        query: { filters: useBaseEncode(JSON.stringify(filters)) },
      });
    }
  });

  watch([search, author, ingredient], () => {
    page.value = 1;
  });

  const resetStatus = ref<"pending" | "done">();

  const resetFilters = () => {
    resetStatus.value = "pending";
    search.value = "";

    setTimeout(() => {
      author.value = "";
      ingredient.value = "";
      page.value = 1;

      resetStatus.value = "done";
    }, 350);
  };

  return {
    search,
    author,
    ingredient,
    page,
    searchDebounced,
    resetStatus,
    resetFilters,
  };
};
