import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/nivel',
    name: 'nivel',
    component: () => import(/* webpackChunkName: "about" */ '../views/HomeNivelVue.vue')
  },
  {
    path: '/cadastros',
    name: 'cadastros',
    component: () => import(/* webpackChunkName: "about" */ '../views/CadastrosView.vue')
  },
  {
    path: '/niveis',
    name: 'niveis',
    component: () => import(/* webpackChunkName: "about" */ '../views/CadastrosNivelView.vue')
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
