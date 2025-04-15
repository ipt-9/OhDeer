import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import navBar from './components/nav-bar.vue'
import searchBar from './components/search-bar.vue'
import LandingPage from './components/LandingPage.vue'

const routes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    component: Login,
    meta: { layout: 'auth' }
  },
  {
    path: '/home',
    component: LandingPage,
  },
  {
    path: '/register',
    component: Register,
    meta: { layout: 'auth' }
  },
  {
    path: '/nav-bar',
    component: navBar,
  },
  {
    path: '/search-bar',
    component: searchBar,
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
