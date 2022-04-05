require('./bootstrap');

import Vue from 'vue';
import Login from './dashboard/login.vue';

new Vue({
    el : '#login',
    render: h => h(Login)
});
