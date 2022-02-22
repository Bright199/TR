// require('./bootstrap');

import { createApp } from 'vue'
import VueApp from '../components/VueApp.vue'
// import HomeComponent from '../components/HomeComponent.vue'
// import NavBar from '../components/Students/NavBar.vue'
import router from '../vuex/vue-router'
import store from '../vuex/vuex'
// import LeftBar from '../components/Students/LeftBar.vue'
// import RightBar from '../components/Students/RightBar.vue'

// interface App {
//     component(name: 'VueApp' ): component: VueApp
// }
const app = createApp(VueApp)
// app.component('VueApp', VueApp)
// app.component('NavBar', NavBar)
// app.component('HomeComponent', HomeComponent)
// app.component('LeftBar', LeftBar)
// app.component('RightBar', RightBar)
app.use(router)
app.use(store)
app.mount('#vueapp')