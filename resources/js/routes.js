import Vue from 'vue'
import Router from "vue-router";
Vue.use(Router);

import IntroComponent from './components/Intro.vue';
import LoginComponent from './components/auth/Login.vue';
import RegestrationComponent from './components/auth/Regestration.vue';
import ListComponent from './components/admin/List.vue';
import ListViewComponent from './components/user/ViewList.vue';


const routes=[
      {
        name: 'intro',
        path: '/',
        component: IntroComponent
    },
    {
        name: 'signin',
        path: '/signin',
        component: LoginComponent
    },
    {
        name: 'regestration',
        path: '/signup',
        component: RegestrationComponent
    },
    {
        name: 'list',
        path: '/list',
        component: ListComponent,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'listview',
        path: '/listview',
        component: ListViewComponent,
         meta: {
            requiresAuth: true
        }
    }
]


const router = new Router({routes});

router.beforeEach((to, from, next) => {
    const authenticatedUser = localStorage.getItem('_token');
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

    if (requiresAuth && ! authenticatedUser) next('signin')
    else next();
});

export default router;
