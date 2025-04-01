import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '@/components/LandingPage.vue';
import CategoryPage from '@/components/CategoryPage.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomePage,
  },
  {
    path: '/category/:slug',
    name: 'Category',
    component: CategoryPage,
    props: true,
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: () => import('@/components/LandingPage.vue'),
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
