
require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('categoriasform-component', require('./components/CategoriasFormComponent.vue').default);
Vue.component('clientesform-component', require('./components/ClientesFormComponent.vue').default);
Vue.component('prestadoresform-component', require('./components/PrestadoresFormComponent.vue').default);
Vue.component('serviciosform-component', require('./components/ServiciosFormComponent.vue').default);
Vue.component('proveedoresform-component', require('./components/ProveedoresFromComponent.vue').default);
Vue.component('contactoproveedoresform-component', require('./components/ContactoProveedoresFormComponent.vue').default);
Vue.component('categoriaproductosform-component', require('./components/CategoriaProductosFormComponent.vue').default);
Vue.component('tablaadministradores-component', require('./components/TablaAdministradoresComponent.vue').default);
Vue.component('tablaprestadores-component', require('./components/TablaPrestadoresComponent.vue').default);
Vue.component('tablaprestadoresform-component', require('./components/TablaPrestadoresFormComponent.vue').default);


import Vue from "vue"
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

const app = new Vue({
    el: '#app',
});
