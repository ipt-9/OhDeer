import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import searchBar from './components/search-bar.vue'
import LandingPage from './components/LandingPage.vue'
import SearchResults from './components/search-results.vue'
import CreateListing from './components/create-listing.vue'
import RepairShopListings from '@/components/RepairShopListings.vue'
import ItemListings from '@/components/ItemListings.vue'
import InspectItem from '@/components/InspectItem.vue'
import InspectRepair from '@/components/InspectRepair.vue'

import ComingSoon from './components/ComingSoon.vue'
import Payment from './components/PaymentScreen.vue'
import Profile from './components/UserProfile.vue'

import settings from './components/UserSettings.vue'
import UserSettings from './components/UserSettings.vue'

const routes = [
  {
    path: '/login',
    component: Login,
    meta: { layout: 'auth' },
  },
  {
    path: '/',
    component: LandingPage,
  },
  {
    path: '/register',
    component: Register,
    meta: { layout: 'auth' },
  },
  {
    path: '/search-bar',
    component: searchBar,
  },
  {
    path: '/settings',
    component: UserSettings,
  },
  {
    path: '/search-results',
    component: SearchResults,
  },
  {
    path: '/create-listing',
    component: CreateListing,
  },
  {
    path: '/comingsoon',
    component: ComingSoon,
  },
  {
    path: '/payment/:id',
    component: Payment,
  },
  {
    path: '/profile/:id',
    component: Profile,
  },
  {
    path: '/repairlistings',
    component: RepairShopListings,
    name: 'RepairListings',
  },
  {
    path: '/marketplace',
    component: ItemListings,
    name: 'Marketplace',
  },
  {
    path: '/inspectitem/:title',
    component: InspectItem,
    name: 'InspectItem',
  },
  {
    path: '/inspectrepair/:title',
    component: InspectRepair,
    name: 'InspectRepair',
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
