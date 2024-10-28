<script setup lang="ts">
import type { UnwrapRef } from "vue";
import type { AsyncDataRequestStatus } from "nuxt/app";

defineProps<{
    name: string;
    status: UnwrapRef<AsyncDataRequestStatus>;
}>();
</script>

<template>
    <h1>
        Recipes
        <span v-if="status === 'pending'" class="text-normal">
            Loading...
        </span>
    </h1>
</template>
