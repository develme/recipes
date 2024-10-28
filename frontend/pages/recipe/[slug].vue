<script setup lang="ts">
const $route = useRoute();

const { slug } = $route.params;

const { data } = useFetch(`/api/recipes/${slug}`);
</script>

<template>
    <div class="main">
        <recipe-title
            :title="data?.data?.name"
            :description="data?.data?.description"
            :author="data?.data?.email"
        >
            <template #subtitle>
                <h4>
                    <nuxt-link :to="{ path: '/' }" class="text-primary">
                        Home
                    </nuxt-link>
                </h4>
                <p>
                    <a
                        class="text-normal pr-1 text-secondary"
                        href="#ingredients"
                    >
                        Ingredients
                    </a>
                    <a class="text-normal text-secondary" href="#steps">
                        Steps
                    </a>
                </p>
            </template>
        </recipe-title>
        <recipe-ingredients :ingredients="data?.data?.ingredients ?? []" />
        <recipe-steps :steps="data?.data?.steps ?? []" />
    </div>
</template>
