import "vue-select/dist/vue-select.css";
import './assets/main.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import AppLayout from '@/components/AppLayout.vue';
import Container from '@/components/Container.vue';
import Icon from '@/components/Icon.vue';
import 'vue3-toastify/dist/index.css';
import App from './App.vue'
import router from './router'
import  VSelect  from "vue-select";

import 'summernote/dist/summernote-lite.css';
import 'summernote/dist/summernote-lite.min.js';

import $ from 'jquery';
window.$ = window.jQuery = $;

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.component('AppLayout', AppLayout)
    .component('Container', Container)
    .component('Icon', Icon)
    .component("Select", VSelect)
    .mount('#app')

