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
}) as any as {
    data: ApiCollectionResponse<Recipe>;
    status: AsyncDataRequestStatus;
};
</script>

<template>
    <div class="main">
        <h1>
            Recipes
            <span class="text-normal" v-if="status === 'pending'">
                Loading...
            </span>
        </h1>
        <div class="flex flex-row width-full mb-2">
            <div class="flex-col">
                <label class="pr-2">Search</label>
                <input label="Search" type="text" v-model="search" />
            </div>
            <div class="flex-col">
                <label class="pr-2">Author</label>
                <input label="Author" type="text" v-model="author" />
            </div>
            <div class="flex-col">
                <label class="pr-2">Ingredient</label>
                <input label="Ingredient" type="text" v-model="ingredient" />
            </div>
        </div>
        <div class="flex flex-row flex-wrap flex-gap-md">
            <template v-if="data" v-for="recipe in data.data">
                <NuxtLink
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
                </NuxtLink>
            </template>
        </div>
        <!-- Pagination -->
        <div class="flex flex-row justify-end width-full">
            <button @click="page--" :disabled="page === 1" class="m-1">
                Previous
            </button>
            <button @click="page++" class="m-1">Next</button>
        </div>
    </div>
</template>
