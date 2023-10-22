<script setup lang="ts">
import { useRoute, useRouter, type LocationQueryValue, type LocationQueryRaw } from 'vue-router';
import { ref, computed, onMounted, watch } from 'vue';
import SearchIcon from './components/SearchIcon.vue';
import ArticlePreview from '@/modules/article/components/ArticlePreview.vue';
import type { Article } from '@/types';

const route = useRoute();
const router = useRouter();

const search = ref<LocationQueryValue | LocationQueryValue[]>(route.query.search || '');
const articles = ref<Article[]>([]);
const errorMessage = ref<string>('');

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
        if (allArticles.length === 0) {
            errorMessage.value = 'Nasz blog nie posiada żadnych artykułów.'
        }
    } catch (error) {
        errorMessage.value = 'Wystapił problem podczas pobierania artykułów.';
    }
});

watch(search, () => {
    const query: LocationQueryRaw = {};
    if (search.value !== '') {
        query.search = search.value;
    }
    router.push({ query });
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
        <template v-for="article in filteredArticles" :key="article.id">
            <router-link :to="`/article/${article.id}`">
                <ArticlePreview :article="article" />
            </router-link>
        </template>
        <p v-if="errorMessage !== ''">
            {{ errorMessage }}
        </p>
        <p v-if="errorMessage === '' && filteredArticles.length === 0">
            Nie znaleźliśmy artykułów mających w tytule lub z kategorią: "{{ search }}"
        </p>
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
