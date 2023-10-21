<script setup lang="ts">
import type { Article } from '@/types';

type Props = {
    article: Article;
};
defineProps<Props>();
</script>

<template>
    <router-link :to="`/article/${article.id}`" class="article">
        <h5>{{ article.title }}</h5>
        <div>{{ article.pubDate }}</div>
        <div>{{ article.category }}</div>
        <div>{{ article.description }}</div>
    </router-link>
</template>

<style scoped>
.article {
    margin-bottom: 1rem;
    border: 1px solid black;
    border-radius: 10px;
    padding: 1rem;
    display: block;
}
</style>
