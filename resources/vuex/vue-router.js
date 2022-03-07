import { createRouter, createWebHistory } from 'vue-router';
import RightBar from '../components/Students/RightBar.vue';
import EditStudentProfile from '../components/Students/EditStudentProfile.vue';
import EditProfile from '../components/Students/EditProfile.vue';
import RightNavMain from '../components/RightNavMain.vue';
import StudentAd from '../components/Students/StudentAds/StudentAd.vue';
import StudentAdManagement from '../components/Students/StudentAds/StudentAdManagement.vue';
import StudentDashboard from '../components/Students/StudentDashboard.vue';
import Messages from '../components/Students/Messages/Messages.vue';
import Teachers from '../components/Students/Teachers.vue';
import SingleTeacher from '../components/Students/SingleTeacher.vue';
import Favorites from '../components/Students/Favorites/Favorites.vue';


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
    {
        path: '/student/favorite',
        name: ' Favorites',
        component: Favorites,
    },
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
    {
        path: '/student/ad/management',
        name: "StudentAdmanagement",
        component: StudentAdManagement
    },
    {
        path: '/student/messages',
        name: "Messages",
        component: Messages
    },
    {
        path: '/student/teachers',
        name: "Teachers",
        component: Teachers
    },
    {
        path: '/student/single/teacher/:id',
        // name: "SingleTeacher",
        // component: SingleTeacher,
        components: { default: SingleTeacher },
        props: { default: true }
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;