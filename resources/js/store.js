import {createStore} from "vuex";

export default createStore({
    state: {
        token: localStorage.getItem('jwt_token') || '',
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem('jwt_token', token);
            state.token = token;
        },
        clearToken(state) {
            localStorage.removeItem('jwt_token');
            state.token = '';
        }
    }
});
