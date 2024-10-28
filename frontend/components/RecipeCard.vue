<script setup lang="ts">
import type { Recipe } from "~/types/recipe";

defineProps<{
    recipe: Recipe;
}>();
</script>

<template>
    <nuxt-link
        class="card flex flex-column"
        :to="{
            name: 'recipe-slug',
            params: { slug: recipe.slug },
        }"
    >
        <h3 class="flex-shrink text-primary">
            {{ recipe.name }}
        </h3>
        <p class="flex-col">{{ recipe.description }}</p>
        <p class="flex-shrink">
            <span class="text-small">
                {{ recipe.email }}
            </span>
        </p>
    </nuxt-link>
</template>
