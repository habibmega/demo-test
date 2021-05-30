require('./bootstrap');
window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueAxios from 'vue-axios';
import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './App.vue';
import router from "./routes.js";

Vue.use(VueAxios, axios);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
