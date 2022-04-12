import Vue from 'vue';
import Router from 'vue-router';
import Home from './dashboard/views/home.vue'; 
import Register from './dashboard/views/register.vue'; 
import Fight from './dashboard/views/fight.vue';
import Betting from './dashboard/views/betting.vue';
Vue.use(Router);

export default new Router({
    mode : 'history',
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve({selector : to.hash});
                }, 1000);
            });
        }
        return {x : 0, y : 0};
    },
    routes : [
        {
            path : '/',
            name : 'index',
            component : Home
        }, 
        {
            path : '/register',
            name : 'register',
            component : Register
        },
        {
            path : '/fight',
            name : 'fight',
            component : Fight
        },
        {
            path : '/betting',
            name : 'betting',
            component : Betting
        },
    ]
});