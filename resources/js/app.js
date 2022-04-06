require('./bootstrap');

import Vue from 'vue';
import router from './router';
import Dashboard from './dashboard/dashboard.vue';
import store from './store';

new Vue({
    el : '#dashboard',
    router,
    store,
    render: h => h(Dashboard)
});

