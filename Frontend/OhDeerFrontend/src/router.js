import { createRouter, createWebHistory } from 'vue-router';
import RepairShopListings from '@/components/RepairShopListings.vue';
import ItemListings from '@/components/ItemListings.vue';

const routes = [
  { path: '/RepairListings', component: RepairShopListings, name: 'RepairListings' },
  { path: '/ItemListings', component: ItemListings, name: 'ItemListings' },
  { path: '/InspectItem/:title-:id', component: () => import ('@/components/InspectItem.vue'), name: 'InspectItem' },
  { path: '/InspectRepair/:title-:id', component: () => import ('@/components/InspectRepair.vue'), name: 'InspectRepair' },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
