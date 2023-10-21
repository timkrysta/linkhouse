<script setup lang="ts">
import type { Article } from '@/types';
import TheFilters from './components/TheFilters.vue'
import TheArticle from './components/TheArticle.vue'
import { ref, watchEffect } from 'vue';

let articles = ref<Article[]>([]);

watchEffect(async () => {
  const url = 'http://localhost:8000/api/articles';
  const response = await fetch(url);
  articles.value = await response.json();
}); 
</script>

<template>
  <TheFilters />
  <main>
    <template v-for="article in articles" :key="article.id">
      <TheArticle :article="article" />
    </template>
  </main>
</template>
