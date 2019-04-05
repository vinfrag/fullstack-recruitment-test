/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./axios');

window.Vue = require('vue');

window.Event = new class {
  constructor () {
    this.vue = new Vue();
  }

  fire (event, data = null) {
    this.vue.$emit(event, data);
  }

  listen (event, callback) {
    this.vue.$on(event, callback);
  }
}

Vue.prototype.$http = axios;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('main-component', require('./components/MainComponent.vue'));
Vue.component("search-component", require("./components/SearchComponent.vue"));
Vue.component("result-component", require("./components/ResultComponent.vue"));
Vue.component("links-component", require("./components/LinksComponent.vue"));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});