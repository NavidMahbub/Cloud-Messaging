// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
// import cssVars from 'css-vars-ponyfill'
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router'

import store from "./store/index";
import axios from 'axios'


require('./assets/css/style.css');
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
import Auth from './packages/Auth'
import iziToast from 'izitoast'
import Multiselect from 'vue-multiselect'
import CKEditor from '@ckeditor/ckeditor5-vue';

// import JsonExcel from 'vue-json-excel'
// import jsPDF from 'jspdf';
Vue.component('multiselect', Multiselect)
Vue.use( CKEditor );
Vue.use(BootstrapVue,iziToast,Auth)
Vue.prototype.$iziToast = iziToast

//axios.defaults.baseURL = 'http://nishutiapi.bemantech.com'
// axios.defaults.baseURL = 'http://apidemo.rubelgroup.com.bd'
// axios.defaults.baseURL = 'http://recruitingapi.bemantech.com'
axios.defaults.baseURL = 'http://localhost:8000'
axios.defaults.headers.common["Authorization"] = 'Bearer '+ Vue.auth.getToken()

router.beforeEach(
  (to,from,next) => {
    if(to.matched.some(record => record.meta.forVisitors)){
      if(Vue.auth.isAuthenticated())
        next({
          path: '/dashboard'
        })
      else
        next()
    }
      
    else if(to.matched.some(record => record.meta.forAuth)){
      if(!Vue.auth.isAuthenticated())
      next({
        path: '/login'
      })
      else
        next()
    }
      
    else
      next()  
  }
)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {
    App
  }
})
