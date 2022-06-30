import store from './store';
import router from './router';
import vuetify from './vuetify';

import '@mdi/font/css/materialdesignicons.css';
import './assets/scss/app.scss';

import { createApp } from 'vue';
import App from './App.vue';
const app = createApp(App);

console.log(process.env);

app.use(store);
app.use(router);
app.use(vuetify);
app.mount('#app');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const { VUE_APP_API_PORT: apiPort, VUE_APP_API_BASE_URL: apiBaseUrl } = process.env;
const { protocol, hostname } = location;

window.axios.defaults.baseURL = `${protocol}//${hostname}:${apiPort}${apiBaseUrl}`;

window.setToken = token => {
    window.axios.defaults.headers.common['Authorization'] = token;
};
