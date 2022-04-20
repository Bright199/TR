// require('./bootstrap');

import { createApp } from 'vue'
import VueApp from '../components/VueApp.vue'

import router from '../vuex/vue-router'
import store from '../vuex/vuex'

const app = createApp(VueApp)

app.use(router)
app.use(store)
app.mount('#vueapp')