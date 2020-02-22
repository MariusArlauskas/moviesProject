import Vue from 'vue'
import VueRouter from 'vue-router'
import Homepage from '../components/HomePage'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: Homepage
  },
]

const router = new VueRouter({
  mode: 'history',
  routes,
  base: '/'
})

export default router
