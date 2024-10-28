<script setup lang="ts">
const props = defineProps<{
    currentPage?: number;
    perPage?: number;
    length?: number;
    page?: number;
}>();

const emit = defineEmits<{
    (e: "update:page", value: number): void;
}>();

const pageCompute = computed({
    get: () => props.page ?? 1,
    set: (value: number) => emit("update:page", value),
});
</script>

<template>
    <div class="flex flex-row justify-end width-full">
        <button
            class="m-1"
            :disabled="currentPage === undefined || currentPage === 1"
            @click="pageCompute--"
        >
            Previous
        </button>
        <button
            class="m-1"
            :disabled="
                perPage === undefined ||
                length === undefined ||
                length < perPage
            "
            @click="pageCompute++"
        >
            Next
        </button>
    </div>
</template>
