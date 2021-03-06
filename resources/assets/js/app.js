
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('admin-component', require('./components/admin/AdminComponent.vue'));

Vue.component('edit-user-component', require('./components/admin/EditUserComponent.vue'));

Vue.component('manage-profile-component', require('./components/user/ManageProfileComponent.vue'));

Vue.component('test-component', require('./components/TestComponent.vue'));

Vue.component('register-component', require('./components/RegisterComponent.vue'));

Vue.component('login-component', require('./components/LoginComponent.vue'));

Vue.component('home-component', require('./components/HomeComponent.vue'));

Vue.component('public-app-component', require('./components/PublicAppComponent.vue'));

// Import plugin for form validation
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

var csrf_token = $('meta[name="csrf-token"]').attr('content');
Vue.prototype.$csrf_token = csrf_token;

const app = new Vue({
    el: '#app',
    data: {

  }
});
