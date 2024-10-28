<script setup lang="ts">
import type { ApiCollectionResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";
import type { AsyncDataRequestStatus } from "nuxt/app";

const search = ref<string>();
const author = ref<string>();
const ingredient = ref<string>();
const page = ref<number>(1);

const { data, status } = useFetch("/api/recipes", {
    query: {
        search,
        author,
        ingredient,
        page,
    },
}) as unknown as {
    data: ApiCollectionResponse<Recipe>;
    status: AsyncDataRequestStatus;
};
</script>

<template>
    <div class="main">
        <h1>
            Recipes
            <span v-if="status === 'pending'" class="text-normal">
                Loading...
            </span>
        </h1>
        <div class="flex flex-row width-full mb-2">
            <div class="flex-col">
                <label class="pr-2">Search</label>
                <input v-model="search" label="Search" type="text">
            </div>
            <div class="flex-col">
                <label class="pr-2">Author</label>
                <input v-model="author" label="Author" type="text">
            </div>
            <div class="flex-col">
                <label class="pr-2">Ingredient</label>
                <input v-model="ingredient" label="Ingredient" type="text">
            </div>
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
            <button class="m-1" :disabled="page === 1" @click="page--">
                Previous
            </button>
            <button class="m-1" @click="page++">Next</button>
        </div>
    </div>
</template>
