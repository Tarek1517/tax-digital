import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Index.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('@/views/Index.vue')
    },
    {
      path: '/price',
      name: 'Package',
      component: () => import('@/views/Package/Index.vue')
    },
    {
      path: '/service',
      name: 'Service',
      component: () => import('@/views/Service/Index.vue')
    },
    {
      path: '/about',
      name: 'About',
      component: () => import('@/views/About/Index.vue')
    },
    {
      path: '/contact',
      name: 'Contact',
      component: () => import('@/views/Contact/Index.vue')
    },
      // Auth
      {
          path: '/admin/login',
          name: 'Login',
          component: () => import('@/views/Dashboard/Auth/Login.vue')
      },

      //dashboard
      {
          path: '/admin/dashboard',
          name: 'Dashboard',
          component: () => import('@/views/Dashboard/Index.vue')
      },
	  {
	  	path:'/admin/service-category', 
		name:'AdminServiceCategory',
		component: () => import('@/views/Dashboard/ServiceCategory/Index.vue')
	  },
	  {
	  	path:'/admin/create-category', 
		name:'AdminCreateCategory',
		component: () => import('@/views/Dashboard/ServiceCategory/Create.vue')
	  },
	  {
	  	path:'/admin/edit-category/:id', 
		name:'AdminEditCategory',
		component: () => import('@/views/Dashboard/ServiceCategory/Edit.vue')
	  },
      {
          path: '/admin/service',
          name: 'AdminService',
          component: () => import('@/views/Dashboard/Services/Index.vue')
      },
      {
          path: '/admin/create-service',
          name: 'AdminCreateService',
          component: () => import('@/views/Dashboard/Services/Create.vue')
      },
      {
          path: '/admin/edit-service',
          name: 'AdminEditService',
          component: () => import('@/views/Dashboard/Services/Edit.vue')
      },

      //Package Route
      {
          path: '/admin/package',
          name: 'AdminPackage',
          component: () => import('@/views/Dashboard/Package/Index.vue')
      },
      {
          path: '/admin/create-package',
          name: 'AdminCreatePackage',
          component: () => import('@/views/Dashboard/Package/Create.vue')
      },
      {
          path: '/admin/edit-package',
          name: 'AdminEditPackage',
          component: () => import('@/views/Dashboard/Package/Edit.vue')
      },
      {
          path: '/admin/setting',
          name: 'AdminSetting',
          component: () => import('@/views/Dashboard/Setting/Index.vue')
      },
  ]
})

export default router
