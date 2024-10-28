<script setup lang="ts">
import type { ApiCollectionResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";
import type { AsyncDataRequestStatus } from "nuxt/app";
import { refDebounced } from "@vueuse/core";

const $route = useRoute();
const $router = useRouter();

const search = ref<string>();
const author = ref<string>();
const ingredient = ref<string>();
const page = ref<number>(1);

if ($route.query.filters) {
    const filters = JSON.parse(useBaseDecode($route.query.filters as string));
    search.value = filters.search;
    author.value = filters.author;
    ingredient.value = filters.ingredient;
    page.value = filters.page;
}
const searchDebounced = refDebounced(search, 500);

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

const resetStatus = ref<"pending" | "done">();

const resetFilters = () => {
    resetStatus.value = "pending";
    search.value = "";

    setTimeout(() => {
        author.value = "";
        ingredient.value = "";
        page.value = 1;

        resetStatus.value = "done";
    }, 550);
};
</script>
<template>
    <div class="main">
        <h1>
            Recipes
            <span
                v-if="status === 'pending' || resetStatus === 'pending'"
                class="text-normal"
            >
                Loading...
            </span>
        </h1>
        <div class="flex flex-row width-full mb-1">
            <div class="flex-col">
                <label class="pr-2">Search</label>
                <input v-model="search" label="Search" type="text" />
            </div>
            <div class="flex-col">
                <label class="pr-2">Author</label>
                <input v-model="author" label="Author" type="text" />
            </div>
            <div class="flex-col">
                <label class="pr-2">Ingredient</label>
                <input v-model="ingredient" label="Ingredient" type="text" />
            </div>
        </div>
        <div class="mb-2">
            <button @click="resetFilters">Reset</button>
        </div>
        <div v-if="data" class="flex flex-row flex-wrap flex-gap-md">
            <template v-for="recipe in data.data" :key="recipe.data.slug">
                <nuxt-link
                    class="card flex flex-column"
                    :to="{
                        name: 'recipe-slug',
                        params: { slug: recipe.data.slug },
                    }"
                >
                    <h3 class="flex-shrink text-primary">
                        {{ recipe.data.name }}
                    </h3>
                    <p class="flex-col">{{ recipe.data.description }}</p>
                    <p class="flex-shrink">
                        <span class="text-small">
                            {{ recipe.data.email }}
                        </span>
                    </p>
                </nuxt-link>
            </template>
        </div>
        <!-- Pagination -->
        <div class="flex flex-row justify-end width-full">
            <button
                class="m-1"
                :disabled="data.meta.current_page === 1"
                @click="page--"
            >
                Previous
            </button>
            <button
                class="m-1"
                :disabled="data.data.length < data.meta.per_page"
                @click="page++"
            >
                Next
            </button>
        </div>
    </div>
</template>
