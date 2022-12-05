import indexPage from "pages/IndexPage";
import Login from "pages/Login";
import User from "pages/User";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: indexPage ,meta: {requiresAuth: true}},
      { path: 'user', component: User,meta: {requiresAuth: true}},
    ]
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
