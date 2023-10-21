<script setup lang="ts">
import type { Article } from '@/types';

type Props = {
    article: Article;
};
defineProps<Props>();
</script>

<template>
    <router-link :to="`/article/${article.id}`" class="card mb-3">
        <h2 class="title mb-2">{{ article.title }}</h2>
        <div class="badge-container mb-2">
            <template v-for="category in article.category" :key="category">
                <span class="badge">{{ category }}</span>
            </template>
        </div>
        <div class="lead">{{ article.description }}</div>
        <div class="publishDate">Opublikowano: {{ article.pubDate }}</div>
    </router-link>
</template>

<style scoped>
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

.card:hover {
    background-color: #f3f3f3;
}

.title {
    margin-top: 0;
}

.lead,
.publishDate {
    color: #6c757d;
}

.lead {
  font-size: .9rem;
  font-weight: 300;
  line-height: 1.6;
}
.publishDate {
    font-size: .6rem;
    margin-top: .25rem;
    text-align: end;
}
</style>
