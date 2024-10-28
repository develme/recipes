<script setup lang="ts">
import { useRecipeSeoDescription } from "~/composables/receipt/seo";

const $route = useRoute();

const { slug } = $route.params;

const { data } = useFetch(`/api/recipes/${slug}`);

if (data.value) {
    const description = computed(() => {
        const recipe = data.value?.data;

        return recipe ? useRecipeSeoDescription(recipe) : "";
    });

    useHead({
        title: () => data.value?.data?.name as string,
        meta: [
            {
                name: "description",
                content: () => description.value as string,
            },
        ],
    });

    useSeoMeta({
        title: () => data.value?.data?.name as string,
        ogTitle: () => data.value?.data?.name as string,
        description: () => description.value as string,
        ogDescription: () => description.value as string,
        author: () => data.value?.data?.email as string,
        creator: () => data.value?.data?.email as string,
        publisher: () => data.value?.data?.email as string,
        robots: "index, follow",
        ogUrl: () => `${window.location.origin}/recipe/${slug}`,
        ogType: "article",
    });
}
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
