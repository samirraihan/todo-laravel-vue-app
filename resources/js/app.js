require('./bootstrap');

window.Vue = require('vue').default;

//Import View Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Routes
import { routes } from './routes';

//Register Routes
const router = new VueRouter({
    routes, 
    mode: 'hash',
	mode: "history",
	base: 'todo-app'

})

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});