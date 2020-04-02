/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

import moment from 'moment'
window.moment = moment;


Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('goods-details', require('./components/GoodsDetails.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const routes = [
    {path: '/', name: 'index', component: Vue.component('Index')},
    {path: '/goods-details/:id', name: 'details', component:  Vue.component('GoodsDetails')},
    {path: '/goods-details/edit/:id', name: 'edit', component:  Vue.component('GoodsEdit')},
    {path: '/create', name: 'create', component:  Vue.component('GoodsCreate')},
];

const router = new VueRouter({
    routes
});

Vue.filter('formatDate', function (date) {
    return moment(date).format('ll');
});

Vue.filter('withSpaces', function (number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
});


const app = new Vue({
    router,
    el: '#app'
});
