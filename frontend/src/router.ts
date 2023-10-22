import { createRouter, createWebHistory } from 'vue-router';
import ArticlesShow from '@/modules/article/ArticlesShow/ArticlesShow.vue';
import ArticlesIndex from '@/modules/article/ArticlesIndex/ArticlesIndex.vue';
import TheError404 from '@/modules/errors/404/TheError404.vue';

const routes = [
    { path: '/', component: ArticlesIndex },
    { path: '/article/:id', component: ArticlesShow },
    { path: '/404', component: TheError404 },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
