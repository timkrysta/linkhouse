<script setup lang="ts">
import { useRoute, useRouter } from 'vue-router';
import { ref, watchEffect } from 'vue';
import type { Article } from '@/types';
import ArticleDetails from './components/ArticleDetails.vue';
import BackButton from './components/BackButton.vue';

let article = ref<Article | null>(null);

const router = useRouter();

watchEffect(async () => {
    try {
        const route = useRoute();
        const url = `http://localhost:8000/api/article/${route.params.id}`;
        const response = await fetch(url);
        article.value = await response.json();
    } catch (error) {
        router.push({ path: '/404' });
    }
});

</script>

<template>
    <BackButton />
    <ArticleDetails v-if="article !== null" :article="article" />
</template>
