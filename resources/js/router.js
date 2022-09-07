import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './pages/Home.vue'
import SearchAccomodations from './pages/SearchAccomodations.vue'
import Accomodation from './pages/Accomodation.vue'


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
        {
            path: '/accomodation/:id',
            name: 'accomodation',
            component: Accomodation
        },  
    ]
})

export default router;