import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export const routes = [
  {
    path: 'dashboard',
    name: 'Dashboard',
    component: () => import('@/views/dashboard'),
    meta: { title: 'Dashboard' }
  },
  {
    path: 'item',
    name: 'Item',
    component: () => import('@/views/dashboard'),
    meta: { title: 'Item' }
  },
  {
    path: 'other_item',
    name: 'OtherItem',
    component: () => import('@/views/dashboard'),
    meta: { title: 'Other item' }
  },
  {
    path: 'nested',
    component: () => import('@/views/dashboard'),
    meta: { title: 'Nested menu' },
    children: [
      {
        path: '1',
        name: 'NestedItem1',
        component: () => import('@/views/dashboard'),
        meta: { title: 'Nested item 1' },
        children: [
          {
            path: '1',
            name: 'NestedItem11',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 1-1' },
          },
          {
            path: '2',
            name: 'NestedItem12',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 1-2' },
          },
          {
            path: '3',
            name: 'NestedItem13',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 1-3' },
          }
        ]
      },
      {
        path: '2',
        redirect: { name: 'NestedItem21' },
        component: () => import('@/views/dashboard'),
        meta: { title: 'Nested item 2' },
        children: [
          {
            path: '1',
            name: 'NestedItem21',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 2-1' },
          },
          {
            path: '2',
            name: 'NestedItem22',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 2-2' },
          },
          {
            path: '3',
            name: 'NestedItem23',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 2-3' },
          }
        ]
      },
      {
        path: '3',
        redirect: { name: 'NestedItem31' },
        component: () => import('@/views/dashboard'),
        meta: { title: 'Nested item 3' },
        children: [
          {
            path: '1',
            name: 'NestedItem31',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 3-1' },
          },
          {
            path: '2',
            name: 'NestedItem32',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 3-2' },
          },
          {
            path: '3',
            name: 'NestedItem33',
            component: () => import('@/views/dashboard'),
            meta: { title: 'Nested item 3-3' },
          }
        ]
      }
    ],
  },
  {
    path: 'users',
    name: 'UserList',
    component: () => import('@/views/user'),
    meta: { title: 'Users' }
  }
]

export const direct_routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/login'),
  },
  {
    path: '/404',
    name: 'Error404',
    component: () => import('@/views/error-page/404'),
  }
]

const router = new VueRouter({
  // mode: 'history',
  routes: [
    ...direct_routes,
    {
      path: '/',
      component: () => import('@/layout/MainLayout'),
      redirect: 'dashboard',
      children: routes
    },
    { path: '*', redirect: '/404', hidden: true },
  ],
})

export default router
