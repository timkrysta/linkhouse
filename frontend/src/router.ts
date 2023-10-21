import { createRouter, createWebHistory } from 'vue-router';
import ArticlesShow from '@/modules/article/ArticlesShow/ArticlesShow.vue';
import ArticlesIndex from '@/modules/article/ArticlesIndex/ArticlesIndex.vue';

const routes = [
    { path: '/', component: ArticlesIndex },
    { path: '/article/:id', component: ArticlesShow },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
