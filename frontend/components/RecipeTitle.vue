<script setup lang="ts">
defineProps<{
    title: string;
    description: string;
    author: string;
}>();
</script>

<template>
    <div>
        <h1 class="mt-1">{{ title }}</h1>
        <p class="mb-2">{{ author }}</p>
        <slot name="subtitle" />
        <p>{{ description }}</p>
    </div>
</template>
