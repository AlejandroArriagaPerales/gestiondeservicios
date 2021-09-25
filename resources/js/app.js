
require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('categoriasform-component', require('./components/CategoriasFormComponent.vue').default);

const app = new Vue({
    el: '#app',
});
