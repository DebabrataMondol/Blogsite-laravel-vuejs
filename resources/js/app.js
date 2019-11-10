require('./bootstrap');
window.Vue = require('vue');

//vuex support
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)

//support moment js
import {filter} from './filter.js'

//vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import {routes} from './routes';
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-main', require('./components/admin/AdminMaster.vue').default);
Vue.component('home-main', require('./components/public/publicMaster.vue').default);

/*v-form*/
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)



//Sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
})
window.Toast = Toast





const router = new VueRouter({
  routes,
  mode:'hash'
})

const app = new Vue({
    el: '#app',
    router,
    store
});
