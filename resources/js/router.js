import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './pages/Home.vue'
import SearchAccomodations from './pages/SearchAccomodations.vue'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },      
        {
            path: '/searchaccomodations',
            name: 'searchaccomodations',
            component: SearchAccomodations
        },      
    ]
})

export default router;