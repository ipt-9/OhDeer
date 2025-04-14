import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import navBar from './components/nav-bar.vue'
<<<<<<< HEAD

=======
>>>>>>> 0911fc7 (Achieved all requested functionality, just need to fix some css and the navbar should be ready to use.)
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
  },
  {
    path: '/nav-bar',
    component: navBar,
<<<<<<< HEAD
  }
=======
  },
>>>>>>> 0911fc7 (Achieved all requested functionality, just need to fix some css and the navbar should be ready to use.)
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
