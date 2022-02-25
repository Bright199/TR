import { createRouter, createWebHistory } from 'vue-router';
import RightBar from '../components/Students/RightBar.vue';
import EditStudentProfile from '../components/Students/EditStudentProfile.vue';
import EditProfile from '../components/Students/EditProfile.vue';
import RightNavMain from '../components/RightNavMain.vue';
import StudentAd from '../components/Students/StudentAds/StudentAd.vue';
import StudentDashboard from '../components/Students/StudentDashboard.vue';


const newLocal = 'Home';
const routes = [
    {
        path: '/',
        name: 'RightNavMain',
        component: RightNavMain
    },
    {
        path: '/student/home',
        name: 'RightNavMain',
        component: RightNavMain
    },
    // {
    //     path: '/student/edit',
    //     name:' EditProfile',
    //     component: EditProfile,
    // },
    {
        path: '/student/dashboard',
        name: 'StudentDashboard',
        component: StudentDashboard
    },
    {
        path: '/student/create/ad',
        name: 'StudentAd',
        component: StudentAd
    },
    {
        path: '/student/edit/profile',
        name: "EditStudentProfile",
        component: EditStudentProfile
    },
    // {
    //     path: '/student/home',
    //     name: "RightNavMain",
    //     component: RightNavMain
    // },
    // {
    //     path: '/student/home',
    //     name: "NavBar",
    //     component: NavBar
    // }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;