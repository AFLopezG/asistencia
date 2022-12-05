import indexPage from "pages/IndexPage";
import Login from "pages/Login";
import User from "pages/User";
import Personal from "pages/Personal";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: indexPage ,meta: {requiresAuth: true}},
      { path: 'user', component: User,meta: {requiresAuth: true}},
      { path: 'personal', component: Personal,meta: {requiresAuth: true}},
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
