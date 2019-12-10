import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './stores';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

import App from './views/App';

import AddBook from "./views/AddBook";
import Repository from "./views/Repository";
import Login from "./views/Login";
import Logout from "./views/Logout";
import RegisterUser from "./views/RegisterUser";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: { name: 'login' }
        },
        {
            path: '/addBook',
            name: 'addBook',
            component: AddBook,
            meta: { requiresAuth: true }
        },
        {
            path: '/repository',
            name: 'repository',
            component: Repository
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterUser
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout
        }
    ],

});

router.beforeEach((to, from, next) => {
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        next({ name: 'login' });
        return
    }
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'repository' });
        return;
    }

    next();
});


const app_vue = new Vue({
    el: '#app',
    components: { App },
    router,
});

export default app_vue;
