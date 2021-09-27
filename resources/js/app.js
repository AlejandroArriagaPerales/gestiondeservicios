
require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('categoriasform-component', require('./components/CategoriasFormComponent.vue').default);
Vue.component('clientesform-component', require('./components/ClientesFormComponent.vue').default);
Vue.component('prestadoresform-component', require('./components/PrestadoresFormComponent.vue').default);
Vue.component('serviciosform-component', require('./components/ServiciosFormComponent.vue').default);

const app = new Vue({
    el: '#app',
});
