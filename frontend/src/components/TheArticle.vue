<script setup lang="ts">
import type { Article } from '@/types';

defineProps<{
  article: Article;
}>();
</script>

<template>
    <a :href="article.link" class="article">
        <h5>{{ article.title }}</h5>
        <div>{{ article.pubDate }}</div>
        <div>{{ article.category }}</div>
        <div>{{ article.description }}</div>
    </a>
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
