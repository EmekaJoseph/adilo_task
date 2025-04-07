
//bootstrap@5.3.5
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

//bootstrap-icons
import 'bootstrap-icons/font/bootstrap-icons.css'


//Vue3ProgressPlugin
import { Vue3ProgressPlugin } from '@marcoschulte/vue3-progress';
import '@marcoschulte/vue3-progress/dist/index.css';

import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(Vue3ProgressPlugin);
app.use(router)

app.mount('#app')
