require('./bootstrap');

import Vue from 'vue';
import router from './router';
import Dashboard from './dashboard/dashboard.vue';

new Vue({
    el : '#dashboard',
    router,
    render: h => h(Dashboard)
});

