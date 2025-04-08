import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Register from './components/Register.vue'

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
    path: '/register',
    component: Register,
    meta: { layout: 'auth' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
