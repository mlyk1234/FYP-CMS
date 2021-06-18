/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vuelidate from 'vuelidate'
import VuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

window.Vue = require('vue');
import VueApexCharts from 'vue-apexcharts'
import Vuetify from "../plugins/vuetify"  
import store from "./store"
import router from "./router"
import VueFormulate from '@braid/vue-formulate'
const messages = {
    email: "Field {attribute} is not a proper email address"
  };

import vueKanban from 'vue-kanban'

Vue.use(VueApexCharts);
Vue.use(vueKanban);
Vue.use(VueFormulate);
Vue.use(Vuelidate);
Vue.use(VuelidateErrorExtractor , {
    messages,
    template: templates.singleErrorExtractor.foundation6,
    attributes: {
      email: 'Email',
    }
  });
  Vue.component('formWrapper', templates.FormWrapper);
  Vue.component('formSummary', templates.multiErrorExtractor.foundation6);
require('/laragon/implement/node_modules/chart.js');
Vue.component('apexchart', VueApexCharts)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('homepage', require('./components/homepage.vue').default);
Vue.component('example-component', require('./components/PlanetChart.vue').default);
Vue.component('api-geter', require('./components/Api.vue').default);

Vue.component('example-component', require('./components/PlanetChart.vue').default);

Vue.component('selector', require('./components/SelectSupervisor.vue').default);

Vue.component('modal', require('./components/Admin/modal.vue').default);

Vue.component('app-container', require('./components/appContainer.vue').default);
Vue.component('login-form', require('./components/loginForm.vue').default);
Vue.component('auth-page', require('./components/AuthPage.vue').default);
Vue.component('register-form', require('./components/registerForm.vue').default);
Vue.component('justview', require('./components/justview.vue').default);
Vue.component('gantt-view', require('./components/gantt-view.vue').default);
Vue.component('kanban', require('./components/tools/kanban.vue').default);
Vue.component('task-card', require('./components/tools/TaskCard.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify: Vuetify,
    store,
    router,
    el: '#app',
});