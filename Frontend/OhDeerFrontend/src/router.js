import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import ComingSoon from './components/ComingSoon.vue'
import Payment from './components/PaymentScreen.vue'
import Profile from './components/Profile.vue'

const routes = [
  {
    path: '/',
  },
  {
    path: '/login',
    component: Login,
    meta: { layout: 'auth' },
  },
  {
    path: '/register',
    component: Register,
    meta: { layout: 'auth' },
  },
  {
    path: '/comingsoon',
    component: ComingSoon,
  },
  { path: '/payment/:id', component: Payment },
  { path: '/profile/:id', component: Profile },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
