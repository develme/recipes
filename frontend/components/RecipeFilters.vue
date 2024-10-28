<script setup lang="ts">
const props = defineProps<{
    search?: string;
    author?: string;
    ingredient?: string;
}>();

const emit = defineEmits<{
    (e: "update:search", value: string | undefined): void;
    (e: "update:author", value: string | undefined): void;
    (e: "update:ingredient", value: string | undefined): void;
    (e: "reset"): void;
}>();

const searchComputed = computed({
    get: () => props.search,
    set: (value: string) => emit("update:search", value),
});

const authorComputed = computed({
    get: () => props.author,
    set: (value: string) => emit("update:author", value),
});

const ingredientComputed = computed({
    get: () => props.ingredient,
    set: (value: string) => emit("update:ingredient", value),
});
</script>

<template>
    <div class="flex flex-row width-full mb-1">
        <div class="flex-col">
            <label class="pr-2">Search</label>
            <input v-model="searchComputed" label="Search" type="text" />
        </div>
        <div class="flex-col">
            <label class="pr-2">Author</label>
            <input v-model="authorComputed" label="Author" type="text" />
        </div>
        <div class="flex-col">
            <label class="pr-2">Ingredient</label>
            <input
                v-model="ingredientComputed"
                label="Ingredient"
                type="text"
            />
        </div>
    </div>

    <div class="mb-2">
        <button @click="emit('reset')">Reset</button>
    </div>
</template>
