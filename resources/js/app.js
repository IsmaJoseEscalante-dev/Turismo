
require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('image-component', require('./components/ImageComponent.vue').default);
Vue.component('show-image-component', require('./components/ShowImage.vue').default);
Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('count-comment', require('./components/CountComment.vue').default);
Vue.component('pay-component', require('./components/PeyComponent.vue').default);
Vue.component('booking-component', require('./components/BookingComponent.vue').default);
Vue.component('promotion-component', require('./components/PromotionComponent.vue').default);
Vue.component('event-component', require('./components/EventComponent.vue').default);
Vue.component('tour-component', require('./components/TourComponent.vue').default);

const app = new Vue({
    el: '#app',
});
