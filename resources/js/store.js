import { createStore } from "vuex";
// import Vue from 'vue';

// use.new(Vue);

export default createStore({
    state: {
        token: localStorage.getItem('jwt_token') || '',
    },
    mutations: {
        setTocken(state, token) {
            localStorage.setItem('jwt_token', token);
            state.token = token;
        },
        clearTocken(state) {
            localStorage.removeItem('jwt_token');
            state.token = '';
        }
    }
});