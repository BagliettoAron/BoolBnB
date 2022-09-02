import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './pages/Home.vue'
import About from './pages/About.vue'
import AccomodationsContainer from './pages/AccomodationsContainer.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },     
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/accomodationscontainer',
            name: 'accomodationscontainer',
            component: AccomodationsContainer
        },     
    ]
})

export default router;