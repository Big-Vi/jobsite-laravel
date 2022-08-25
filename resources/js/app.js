/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
window.axios = require('axios');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(require('vue-resource'));
Vue.component('home', require('./components/Home.vue').default);
Vue.component('jobcard', require('./components/carousel/Jobcard.vue').default);
Vue.component('carousel', require('./components/carousel/Carousel.vue').default);
Vue.component('arrowbutton', require('./components/carousel/Arrowbutton.vue').default);
Vue.component('jobs', require('./components/Jobs.vue').default);
Vue.component('showjob', require('./components/jobseeker/Showjob.vue').default);
Vue.component('searchbar', require('./components/Searchbar.vue').default);
Vue.component('jobalert', require('./components/Jobalert.vue').default);
Vue.component('jobalertedit', require('./components/JobalertEdit.vue').default);
Vue.component('createjobcategory', require('./components/CreatejobCategory.vue').default);
Vue.component('editjobcategory', require('./components/EditjobCategory.vue').default);
Vue.component('employerindex', require('./components/employer/Employer.vue').default);
Vue.component('appliedjob', require('./components/jobseeker/Appliedjob.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(require('vue-moment'));
const app = new Vue({
  el: '#app',
});
