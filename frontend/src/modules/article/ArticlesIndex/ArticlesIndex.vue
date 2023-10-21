<script setup lang="ts">
import { useRoute, useRouter, type LocationQueryValue } from 'vue-router';
import { ref, computed, onMounted, watch } from 'vue';
import SearchIcon from '@/components/icons/SearchIcon.vue';
import ArticlePreview from './components/ArticlePreview.vue';
import type { Article } from '@/types';

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
                <SearchIcon />
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
