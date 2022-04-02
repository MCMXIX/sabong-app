import Vue from 'vue';
import Router from 'vue-router';
import Home from './dashboard/views/home.vue'; 

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
    ]
});