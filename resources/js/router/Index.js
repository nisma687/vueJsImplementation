// resources/js/routes.js
import { createRouter, createWebHistory } from 'vue-router';
// import Home from '@/pages/Home.vue';
// import About from '@/pages/About.vue';
// import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';

const AuthenticatedLayout = () => import('@/layouts/AuthenticatedLayout.vue');
const DashBoardLayout = () => import('@/layouts/DashBoardLayout.vue');

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
      },
      {
        path: 'login',
        name: 'Login',
        component: () => import('@/pages/Login.vue')
      },
      {
        path: 'register',
        name: 'Register',
        component: () => import('@/pages/Register.vue')
      }
      
    ]
  },
  {
    path: '/dashboard',
    component: DashBoardLayout,
    children: [
      {
        path: '',
        name: 'DashBoard',
        component: () => import('@/pages/DashBoard.vue')
      },
      {
        path: 'profile',
        name: 'Profile',
        component: () => import('@/pages/Profile.vue')
      },
      {
        path:"edit-profile",
        name:"EditProfile",
        component: () => import('@/pages/EditProfile.vue')

      }
      // {
      //   path: 'settings',
      //   name: 'Settings',
      //   component: () => import('@/pages/Settings.vue')
      // },
     
    ]
  }
 
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
