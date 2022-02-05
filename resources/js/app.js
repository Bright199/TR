// require('./bootstrap');

import { createApp } from 'vue'
import VueApp from '../components/VueApp.vue'
import router from '../vuex/vue-router'

const app = createApp(VueApp)
app.use(router)
app.mount('#vueapp')