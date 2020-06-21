import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';

/**/


/**/
import store from '../store';
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        redirect: '/',
        component: () => import('../components/Home/indexComponent'),
    },
    {
        path: '/admin',
        component: () => import('../components/admin/index'),
        name: 'Admin',
        children: [
            {
                path: 'users',
                component: () => import('../components/admin/pages/users/index'),
                name: 'Users'
            },
            {
                path: 'apps',
                component: () => import('../components/admin/pages/apps/index'),
                name: 'Apps'
            },
            {
                path: 'scores',
                component: () => import('../components/admin/pages/scores/index'),
                name: 'Scores'
            },
            {
                path: 'questions',
                component: () => import('../components/admin/pages/questions/index'),
                name: 'Questions'
            },
            {
                path: 'wins',
                component: () => import('../components/admin/pages/wins/index'),
                name: 'Wins'
            },
        ],
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('token')) {
                next();
            } else {
                next('/login');
            }
        },
    },
    {
        path: '/login',
        component: () => import('../components/admin/pages/login'),
        name: 'Login',
    }
];

export default new VueRouter({
    mode: 'hash',
    base: process.env.BASE_URL,
    routes
})

/*import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    mode: 'hash',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            component: () => import('../components/admin/index'),
            children: [
                // Dashboard
                {
                    name: 'Dashboard',
                    path: '',
                    // component: () => import('../components/admin/Dashboard'),
                },
                // Pages
            ],
        },
    ],
})*/
