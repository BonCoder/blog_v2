/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './App.vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import store from './store.js'
import router from './router'
import hljs from 'highlight.js'


// import $http from './requests'
//
// Vue.prototype.$http = $http

Vue.use(ElementUI);

const app = new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});