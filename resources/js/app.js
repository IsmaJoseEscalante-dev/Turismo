
require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('image-component', require('./components/ImageComponent.vue').default);
Vue.component('show-image-component', require('./components/ShowImage.vue').default);
Vue.component('form-booking-component', require('./components/BookingComponent.vue').default);

const app = new Vue({
    el: '#app',
});
