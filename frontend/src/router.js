import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';
import Gallery from './views/Gallery.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/gallery',
            name: 'gallery',
            component: Gallery
        }
    ]
});
