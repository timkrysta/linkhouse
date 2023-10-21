<script setup lang="ts">
import type { Article } from '@/types';

type Props = {
    article: Article;
};
defineProps<Props>();
</script>

<template>
    <h5>{{ article.title }}</h5>
    <div>{{ article.pubDate }}</div>
    <div>{{ article.category }}</div>
    <div>{{ article.description }}</div>
</template>
