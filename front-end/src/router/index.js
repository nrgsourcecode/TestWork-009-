import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "not-logged-in" */ '../views/LoginView.vue')
    },
    {
        path: '/',
        name: 'register',
        component: () => import(/* webpackChunkName: "not-logged-in" */ '../views/RegisterView.vue')
    },
    {
        path: '/home',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue')
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router;
