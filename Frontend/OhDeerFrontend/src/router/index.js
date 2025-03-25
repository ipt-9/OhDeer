import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import CategoryPage from '@/views/CategoryPage.vue';

const routes = [
  { path: '/', component: Home, name: 'Home' },
  { path: '/category/:slug', component: CategoryPage, name: 'CategoryPage' }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
