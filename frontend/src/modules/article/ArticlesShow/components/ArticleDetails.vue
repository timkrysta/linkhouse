<script setup lang="ts">
import type { Article } from '@/types';
import ArticlePreview from '@/modules/article/components/ArticlePreview.vue';

type Props = {
    article: Article;
};
defineProps<Props>();
</script>

<template>
    <ArticlePreview :article="article" />
    <div class="card">
        Blog post content
    </div>
</template>
