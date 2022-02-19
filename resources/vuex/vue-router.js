import {createRouter, createWebHistory} from 'vue-router';
import Home from '../components/Home.vue';
import Login from '../components/Auth/Login.vue';
import NavBar from '../components/Students/NavBar.vue';

const newLocal = 'Home';
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: "Login",
        component: Login
    },
    {
        path: '/student/dashboard',
        name: "NavBar",
        component: NavBar
    },
    {
        path: '/student/home',
        name: "NavBar",
        component: NavBar
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;