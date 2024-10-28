<script setup lang="ts">
import type { ApiCollectionResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";
import type { AsyncDataRequestStatus } from "nuxt/app";
import { useFilterBehavior } from "~/composables/receipt/filter-behavior";

const $route = useRoute();
const $router = useRouter();

const {
    search,
    author,
    ingredient,
    page,
    searchDebounced,
    resetStatus,
    resetFilters,
} = useFilterBehavior($router, $route.query.filters);

const { data, status } = useFetch("/api/recipes", {
    query: {
        search: searchDebounced,
        author,
        ingredient,
        page,
    },
}) as unknown as {
    data: ApiCollectionResponse<
        Recipe,
        Record<string, unknown>,
        { per_page: number; current_page: number }
    >;
    status: AsyncDataRequestStatus;
};

const listStatus = computed(() => {
    if (resetStatus.value === "pending") return "pending";

    return status;
});
</script>
<template>
    <div class="main">
        <list-title name="Recipe" :status="listStatus" />
        <recipe-filters
            v-model:search="search"
            v-model:author="author"
            v-model:ingredient="ingredient"
            @reset="resetFilters"
        />
        <div v-if="data" class="flex flex-row flex-wrap flex-gap-md">
            <template v-for="recipe in data.data" :key="recipe.data.slug">
                <recipe-card :recipe="recipe.data" />
            </template>
        </div>
        <list-pagination
            v-model:page="page"
            :current-page="data?.meta?.current_page"
            :per-page="data?.meta?.per_page"
            :length="data?.data?.length"
        />
    </div>
</template>
