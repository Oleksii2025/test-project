import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from './App.vue';
import router from './router/index.js';
import store from "./store.js";

const app = createApp({ extends: App })
    .use(router)
    .use(store)
    .mount("#app");

export { app }

axios.interceptors.request.use(config => {
    const token = localStorage.getItem('jwt_token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});