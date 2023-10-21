<script setup lang="ts">
import { useRoute, useRouter, type LocationQueryValue } from 'vue-router';
import { ref, computed, onMounted, watch } from 'vue';
import type { Article } from '@/types';
import ArticlePreview from './components/ArticlePreview.vue';

const route = useRoute();
const router = useRouter();

const search = ref<LocationQueryValue | LocationQueryValue[]>(route.query.search || '');

const articles = ref<Article[]>([]);

const filteredArticles = computed(() => {
    const searchString = search.value?.toString().toLowerCase();
    if (searchString === undefined) {
        return articles.value;
    }
    return articles.value.filter(article =>
        article.title.toLowerCase().includes(searchString) ||
        article.category.some(category => category.toLowerCase().includes(searchString))
    );
});

onMounted(async () => {
    const url = 'http://localhost:8000/api/articles';
    try {
        const response = await fetch(url);
        const allArticles: Article[] = await response.json();
        articles.value = allArticles;
    } catch (error) {
        console.error('Error fetching articles:', error);
    }
});

watch(search, () => {
    router.push({
        query: { search: search.value }
    });
});
</script>


<template>
    <div>
        <input type="search" placeholder="Search by title or category" v-model.trim="search" />
        <main>
            <ArticlePreview v-for="article in filteredArticles" :key="article.id" :article="article" />
        </main>
    </div>
</template>
