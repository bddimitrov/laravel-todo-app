require('./bootstrap');

import VueRouter from 'vue-router'
import Todo from './views/Todo.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Vuex from 'vuex'
import axios from 'axios'

window.Vue = require('Vue').default;

const root = require('./views/App.vue').default;

Vue.use(VueRouter);
Vue.use(Vuex);

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        meta: {
            auth: true
        },
        component: Todo
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login');
        return
    }

    next();
});

axios.defaults.baseURL = process.env.MIX_API_URL;

const store = new Vuex.Store({
    state: {
        user: null,
        todos: [],
    },

    mutations: {
        setUserData (state, userData) {
            state.user = userData;
            localStorage.setItem('user', JSON.stringify(userData));
            axios.defaults.headers.common.Authorization = `Bearer ${userData.data.token}`
        },

        clearUserData () {
            localStorage.removeItem('user');
            location.reload()
        },

        setTodos (state, todos) {
            state.todos = todos;
        }

    },

    actions: {
        register ({ commit }, credentials) {
            return axios
                .post('/register', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                });
        },

        login ({ commit }, credentials) {
            return axios
                .post('/login', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                });
        },

        logout ({ commit }) {
            commit('clearUserData');
        },

        loadTodos({ commit }) {
            return axios
                .get('/todos')
                .then(({ data }) => {
                    commit('setTodos', data.data)
                });
        },

        storeTodo({ commit }, data) {
            return axios
                .post('/todos/store', data);
        },

        toggleStatusTodo({ commit }, id) {
            return axios
                .put('/todos/toggle-status/' + id);
        },

        destroyTodo({ commit }, id) {
            return axios
                .delete('/todos/destroy/' + id);
        },
    },

    getters : {
        isLogged: state => !!state.user,
        todos: state => state.todos
    }
});

const app = new Vue({
    el: '#app',
    render: createElement => createElement(root),
    router,
    store,
    created () {
        const userInfo = localStorage.getItem('user')
        if (userInfo) {
            const userData = JSON.parse(userInfo)
            this.$store.commit('setUserData', userData)
        }
    }
});
