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
        <div class="badge-container">
            <template v-for="category in article.category" :key="category">
                <span class="badge">{{ category }}</span>
            </template>
        </div>
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
.badge-container {
    display: flex;
    gap: .5rem;
}
.badge {
  display: inline-block;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: bold;
  background-color: #007bff;
  color: #fff;
}
</style>
