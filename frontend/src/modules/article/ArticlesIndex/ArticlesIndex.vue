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
    <main>
        <h1>Artykuły</h1>
        <div class="card mb-3">
            <div class="searchInput outlined">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#6c757d" style="margin-right: .5rem;">
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
                <input type="search" placeholder="Search by title or category" v-model.trim="search" />
            </div>
        </div>
        <ArticlePreview v-for="article in filteredArticles" :key="article.id" :article="article" />
    </main>
</template>


<style scoped>
.searchInput {
    display: flex;
    align-items: center;
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    padding: 0.375rem 0.75rem;
    background-color: #fff;
}

.searchInput input {
    border: none;
    outline: none;
    background-color: transparent;
    padding: 0;
    margin: 0;
    width: 100%;
}

.searchInput svg {
    color: #6c757d;
    margin-right: 0.5rem;
}

.outlined {
    outline-offset: 2px;
    transition: outline 0.2s ease-in-out;
}
.outlined:focus-within {
    outline: 3px solid #007BFF;
}
</style>
