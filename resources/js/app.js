require('./bootstrap');

import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueRouter from 'vue-router';
import vSelect from 'vue-select';
import store from './store';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueRouter);
Vue.use(vSelect);

Vue.component('app', require('./components/layout/app').default);
Vue.component('weather-today', require('./components/weather-today').default);
Vue.component('weather-five-days', require('./components/weather-five-days').default);
Vue.component('venue', require('./components/venue').default);
Vue.component('v-select', vSelect);

const app = new Vue({
    el: '#app',
    store,
});
