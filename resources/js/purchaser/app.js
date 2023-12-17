// import './bootstrap.js';
import axios from './bootstrap.js'; // Import the custom Axios instance


import { createApp } from 'vue'; // Use destructuring to import only createApp from Vue
import App from './pages/App.vue';
const app = createApp(App);

// Make Axios available globally through app.config.globalProperties
app.config.globalProperties.$axios = axios;

import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'
//use it 
app.use(Toast)

import Vue3Lottie from 'vue3-lottie'
app.use(Vue3Lottie)

app.config.globalProperties.$acidms_platform_purchaser_firstname = localStorage.getItem('acidms_platform_purchaser_firstname');

//
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
app.component('v-select', vSelect)

//
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
app.component('VueDatePicker', VueDatePicker);

//
import VueTimepicker from 'vue3-timepicker'
import 'vue3-timepicker/dist/VueTimepicker.css'
app.component('vue-timepicker', VueTimepicker);


import 'viewerjs/dist/viewer.css'
import VueViewer from 'v-viewer'
app.use(VueViewer)

import router from './router.js';
// import store from './store.js';
app.use(router);
// app.use(store);

// Provide the store instance
// app.provide('store', store);

import mixin from './mixin.js';
app.mixin(mixin);
app.mount('#app');
