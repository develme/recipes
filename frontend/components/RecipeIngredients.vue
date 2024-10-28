<script setup lang="ts">
import type { Ingredient } from "~/types/recipe";

defineProps<{
    ingredients: Ingredient[];
}>();
</script>

<template>
    <h3 id="ingredients" class="text-primary">Ingredients</h3>
    <ul>
        <li v-for="ingredient in ingredients" :key="ingredient.id">
            <p>{{ ingredient.name }}</p>
            <p class="text-thin">{{ ingredient.description }}</p>
        </li>
    </ul>
</template>
