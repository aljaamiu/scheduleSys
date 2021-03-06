 require('./bootstrap');

 window.Vue = require('vue').default;

 window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
 
 import router from './router';
 import App from './layouts/App.vue';
 
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 
 const app = new Vue({
     router,
     el: '#app',
     render: h => h(App)
 });