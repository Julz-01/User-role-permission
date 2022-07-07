import Vue from 'vue';
import vuetify from '../plugins/vuetify';
import store from '../store/index';
import Login from '../pages/Login';

new Vue({
    vuetify,
    store,
    el : "#login-container",
    components: { Login }
});