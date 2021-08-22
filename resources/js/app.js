
require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('image-component', require('./components/ImageComponent.vue').default);
Vue.component('show-image-component', require('./components/ShowImage.vue').default);
Vue.component('form-booking-component', require('./components/BookingComponent.vue').default);
Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('count-comment', require('./components/CountComment.vue').default);
Vue.component('pay-component', require('./components/PeyComponent.vue').default);

const app = new Vue({
    el: '#app',
});
