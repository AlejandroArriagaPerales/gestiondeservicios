
require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('categoriasform-component', require('./components/CategoriasFormComponent.vue').default);
Vue.component('clientesform-component', require('./components/ClientesFormComponent.vue').default);
Vue.component('prestadoresform-component', require('./components/PrestadoresFormComponent.vue').default);
Vue.component('serviciosform-component', require('./components/ServiciosFormComponent.vue').default);
Vue.component('proveedoresform-component', require('./components/ProveedoresFromComponent.vue').default);
Vue.component('contactoproveedoresform-component', require('./components/ContactoProveedoresFormComponent.vue').default);
Vue.component('categoriaproductosform-component', require('./components/CategoriaProductosFormComponent.vue').default);
Vue.component('metodopagoform-component', require('./components/MetodoPagoFormComponent.vue').default);
Vue.component('productosform-component', require('./components/ProductosFormComponent.vue').default);

Vue.component('tablaadministradores-component', require('./components/TablaAdministradoresComponent.vue').default);
Vue.component('tablaprestadores-component', require('./components/TablaPrestadoresComponent.vue').default);
Vue.component('tablaservicios-component', require('./components/TablaServiciosComponent.vue').default);
Vue.component('tablaproveedores-component', require('./components/TablaProveedoresComponent.vue').default);
Vue.component('tablacategoriaproductos-component', require('./components/TablaCategoriaProductosComponent.vue').default);
Vue.component('tablaproductos-component', require('./components/TablaProductosComponent.vue').default);


import Vue from "vue"
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);

const app = new Vue({
    el: '#app',
});
