// resources/js/routes.js
import { createRouter, createWebHistory } from 'vue-router';
// import Home from '@/pages/Home.vue';
// import About from '@/pages/About.vue';
// import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
const AuthenticatedLayout = () => import('@/layouts/AuthenticatedLayout.vue');
const DashBoardLayout = () => import('@/layouts/DashBoardLayout.vue');
const checkUserType=(to,from,next)=>{
  const user = JSON.parse(localStorage.getItem('user'));
  
  if(user.role == 'admin'){
    console.log('ok');
    next();
  }else{
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "You are not authorized to access this page!",
      
    });
    next('/');
  }

}
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
        path: '/all-cources',
        name: 'AllCources',
        component: () => import('@/pages/AllCources.vue')
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
      },
      {
        path:'/create-course',
        name:'CreateCourse',
        component: () => import('@/pages/CreateCourse.vue')
      },
      {
        path: '/update-course/:id',
        name: 'UpdateCourse',
        component: ()=> import('@/pages/UpdateCourse.vue'),
        beforeEnter:checkUserType

        
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

      },
      {
        path:'courses',
        name:'Courses',
        component: () => import('@/pages/Courses.vue')
      },
      
      {
        path:"cart",
        name:"Cart",
        component: () => import('@/pages/Cart.vue')
      }
     
    ]
  }
 
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('token');
  if (!isAuthenticated && to.path !== '/login' && to.path !== '/register') {
    next('/login');
  } else {
    next();
  }
});

export default router;
