require('./bootstrap');

window.Vue = require('Vue').default;

const root = require('./components/Todo.vue').default;

const app = new Vue({
    el: '#app',
    render: createElement => createElement(root)
});
