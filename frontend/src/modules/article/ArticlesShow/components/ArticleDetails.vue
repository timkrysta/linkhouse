<script setup lang="ts">
import type { Article } from '@/types';
import ArticlePreview from '@/modules/article/components/ArticlePreview.vue';
import ArticleContent from './ArticleContent.vue';

type Props = {
    article: Article;
};
defineProps<Props>();
</script>

<template>
    <ArticlePreview :article="article" />
    <ArticleContent v-if="article.html_content !== undefined" :content="article.html_content" />
</template>
