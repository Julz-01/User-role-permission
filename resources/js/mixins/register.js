import Vue from 'vue';
import vuetify from '../plugins/vuetify';
import store from '../store/index';
import Register from '../pages/Register';

new Vue({
    vuetify,
    store,
    el : "#register-container",
    components: { Register }
});