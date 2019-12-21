/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('description', require('./components/DescriptionComponent.vue').default);
Vue.component('create-hotel', require('./components/createHotel.vue').default);
Vue.component('room-listing', require('./components/RoomListComponent.vue').default);
Vue.component('type-component', require('./components/typeComponent.vue').default);
Vue.component('cat-component', require('./components/categoryComponent.vue').default);
Vue.component('created-room', require('./components/createdRoomComponent.vue').default);
Vue.component('price-component', require('./components/priceComponent.vue').default);
Vue.component('created-type', require('./components/createdTypeComponent.vue').default);
Vue.component('booked-component', require('./components/bookComponent.vue').default);
Vue.component('my-booking-component', require('./components/myBookingComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
