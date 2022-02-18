// require('./bootstrap');

import { createApp } from 'vue'
import VueApp from '../components/VueApp.vue'
import NavBar from '../components/Students/NavBar.vue'
import router from '../vuex/vue-router'
import store from '../vuex/vuex'

const app = createApp({})
app.component('NavBar', NavBar)
app.component('VueApp', VueApp)
app.use(router)
app.use(store)
app.mount('#vueapp')