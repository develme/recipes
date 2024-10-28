<script setup lang="ts">
import type { Step } from "~/types/recipe";

defineProps<{
    steps: Step[];
}>();
</script>

<template>
    <h2 id="steps" class="text-primary">Steps</h2>
    <ol>
        <li v-for="step in steps" :key="step.id">
            <div>
                <h3>{{ step.name }}</h3>
                <p>{{ step.description }}</p>
            </div>
        </li>
    </ol>
</template>
