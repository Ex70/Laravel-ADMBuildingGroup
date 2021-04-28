/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import 'moment/locale/es';
import swal from 'sweetalert2'
window.swal = swal;
import Print from 'vue-print-nb'
// Global instruction
Vue.use(Print);

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

import { values } from 'lodash';
import { Form, HasError, AlertError } from 'vform';
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);
Vue.prototype.$empresita = 1;
import VueProgressBar from 'vue-progressbar';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination',require('laravel-vue-pagination'));

import VueRouter from 'vue-router'

const options = {
    color: 'rgb(143,255,199)',
    failedColor: 'red',
    thickness: '4px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }

Vue.use(VueProgressBar, options)

Vue.use(VueRouter)

let routes = [
    {
        path: '/perfilEmpresa/:empresa',
        name: 'perfilEmpresa',
        props: true,
        component: require("./components/Empresa.vue").default
    },
    {
        path: '/dashboard',
        name: 'idEmpresa',
        props: true,
        component: require("./components/Dashboard.vue").default
    },
    { path: '/usuario', component: require("./components/Usuario.vue").default },
    { path: '/home', component: require("./components/Dashboard.vue").default },
    { path: '/developer', component: require("./components/Developer.vue").default },
    // { path: '/perfilEmpresa', component: require('./components/Empresa.vue').default },
    { path: '/empresas', component: require('./components/Empresas.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/estados', component: require('./components/Estados.vue').default },
    { path: '/modulos', component: require('./components/Modulos.vue').default },
    { path: '/unidades', component: require('./components/Unidades.vue').default },
    { path: '/ciudades', component: require('./components/Ciudades.vue').default },
    { path: '/accesos', component: require('./components/Accesos.vue').default },
    { path: '/pptobase/importar', component: require('./components/pptobase/importar.vue').default },
    { path: '/pptobase/consultar', component: require('./components/pptobase/consultar.vue').default },
    { path: '/pptobase/reportes', component: require('./components/pptobase/reportes.vue').default },
    { path: '/pptocliente/autorizar', component: require('./components/pptocliente/autorizar.vue').default },
    { path: '/pptocliente/actualizar', component: require('./components/pptocliente/actualizar.vue').default },
    { path: '/pptocliente/aditivas', component: require('./components/pptocliente/aditivas.vue').default },
    { path: '/pptocliente/deductivas', component: require('./components/pptocliente/deductivas.vue').default },
    { path: '/pptocliente/estimacion', component: require('./components/pptocliente/estimacion.vue').default },
    { path: '/pptocontrol/importar', component: require('./components/pptocontrol/importar.vue').default },
    { path: '/pptocontrol/generar', component: require('./components/pptocontrol/generar.vue').default },
    { path: '/pptocontrol/aditivas', component: require('./components/pptocontrol/aditivas.vue').default },
    { path: '/pptocontrol/deductivas', component: require('./components/pptocontrol/deductivas.vue').default },
    { path: '/pptocontrol/consultar', component: require('./components/pptocontrol/consultar.vue').default },
    { path: '/compras/autorizacion', component: require('./components/compras/autorizacion.vue').default },
    { path: '/compras/captura', component: require('./components/compras/captura.vue').default },
    { path: '/inventarios/por-obra', component: require('./components/inventarios/por-obra.vue').default },
    { path: '/inventarios/compras', component: require('./components/inventarios/compras.vue').default },
    { path: '/inventarios/recuperacion', component: require('./components/inventarios/recuperacion.vue').default },
    { path: '/inventarios/traspaso', component: require('./components/inventarios/traspaso.vue').default },
    { path: '/inventarios/para-obra', component: require('./components/inventarios/para-obra.vue').default },
    { path: '/inventarios/merma', component: require('./components/inventarios/merma.vue').default },
    { path: '/inventarios/traspasos', component: require('./components/inventarios/traspasos.vue').default },
    { path: '/gastos/generales', component: require('./components/gastos/generales.vue').default },
    { path: '/reportes/por-obra', component: require('./components/reportes/por-obra.vue').default },
    { path: '/reportes/por-cliente', component: require('./components/reportes/por-cliente.vue').default },
    { path: '/reportes/generales', component: require('./components/reportes/generales.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
  })

Vue.filter('upText',function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
    //return text.toUpperCase();
});

Vue.filter('myDate',function(created){
    return moment(created).local('es').format('DD MMMM YYYY');
});

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    empresita: 1,
    router,
    data:{
        search:''
    },
    methods:{
        searchit: _.debounce(()=>{
            Fire.$emit('searching');
        },1000),
        printme() {
            console.log("SSS");
            window.print();
        }
    }
});
