<script setup lang="ts">
import type { ApiResponse } from "~/types/api";
import type { Recipe } from "~/types/recipe";

const $route = useRoute();

const { slug } = $route.params;

const { data } = useFetch(`/api/recipes/${slug}`);
</script>

<template>
    <div class="main">
        <h1 class="mt-1">
            {{ data?.data?.name }}
        </h1>
        <h4>
            <NuxtLink :to="{ path: '/' }" class="text-primary">Home</NuxtLink>
        </h4>
        <p>
            <a class="text-normal pr-1 text-secondary" href="#ingredients"
                >Ingredients</a
            >
            <a class="text-normal text-secondary" href="#steps">Steps</a>
        </p>
        <p class="mb-2">{{ data?.data?.email }}</p>
        <p class="mb-2">{{ data?.data?.description }}</p>
        <h3 id="ingredients" class="text-primary">Ingredients</h3>
        <ul>
            <li
                v-for="ingredient in data?.data?.ingredients"
                :key="ingredient.id"
            >
                <p>{{ ingredient.name }}</p>
                <p class="text-thin">{{ ingredient.description }}</p>
            </li>
        </ul>
        <h2 id="steps" class="text-primary">Steps</h2>
        <ol>
            <li v-for="step in data?.data?.steps" :key="step.id">
                <div>
                    <h3>{{ step.name }}</h3>
                    <p>{{ step.description }}</p>
                </div>
            </li>
        </ol>
    </div>
</template>
