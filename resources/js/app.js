
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('image-component', require('./components/ImageComponent.vue').default);
Vue.component('show-image-component', require('./components/ShowImage.vue').default);

const app = new Vue({
    el: '#app',
});
