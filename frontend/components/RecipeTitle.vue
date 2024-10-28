<script setup lang="ts">
defineProps<{
    title?: string;
    description?: string;
    author?: string;
}>();
</script>

<template>
    <div>
        <h1 class="mt-1">{{ title ?? "Recipe" }}</h1>
        <p v-if="author" class="mb-2">{{ author }}</p>
        <slot name="subtitle" />
        <p v-if="description">{{ description }}</p>
    </div>
</template>
