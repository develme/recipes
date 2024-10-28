<script setup lang="ts">
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
