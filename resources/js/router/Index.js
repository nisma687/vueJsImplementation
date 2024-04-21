// resources/js/routes.js
import { createRouter, createWebHistory } from 'vue-router';
// import Home from '@/pages/Home.vue';
// import About from '@/pages/About.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';

const routes = [
  {
    path: '/',
    component: AuthenticatedLayout,
    children: [
      {
        path: '',
        name: 'Home',
        component: () => import('@/pages/Home.vue')
      },
      {
        path: '/about',
        name: 'About',
        component: () => import('@/pages/About.vue')
      }
    ]
  }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
