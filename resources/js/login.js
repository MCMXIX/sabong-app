require('./bootstrap');

import Vue from 'vue';
import Login from './dashboard/login.vue';
import store from './store';

new Vue({
    el : '#login',
    store,
    render: h => h(Login)
});
