import Login from '@/Pages/Auth/Login.vue';
import Home from '@/Pages/Home.vue';
import Quiz from '@/Pages/Quiz.vue';
import Result from '@/Pages/Result.vue';
import { createRouter, createWebHistory } from 'vue-router';



const routes = [
  {
    path: '/',
    name: 'quiz',
    component: Quiz,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/result',
    name: 'result',
    component: Result,
    meta: { requiresAuth: true } // Protect this route
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { guestOnly: true } // Only for guests
  },
  {
    path: '/home',
    name: 'home',
    component: Home,
    meta: { guestOnly: true } // Only for guests
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('auth_token')

  if (!isAuthenticated && to.name !== 'login') {
    next({ name: 'login' })
  } else if (isAuthenticated && to.name === 'login') {
    next({ name: 'home' })
  } else {
    next()
  }
})


export default router;
