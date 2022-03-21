import { createRouter, createWebHistory } from 'vue-router';
import RightBar from '../components/Students/RightBar.vue';
import EditStudentProfile from '../components/Students/EditStudentProfile.vue';
import EditProfile from '../components/Students/EditProfile.vue';
import RightNavMain from '../components/RightNavMain.vue';
import StudentAd from '../components/Students/StudentAds/StudentAd.vue';
import StudentAdManagement from '../components/Students/StudentAds/StudentAdManagement.vue';
import StudentDashboard from '../components/Students/StudentDashboard.vue';
import Messages from '../components/Students/Messages/Messages.vue';
import SingleMessage from '../components/Students/Messages/SingleMessage.vue';
import Teachers from '../components/Students/Teachers.vue';
import FreelanceTeachers from '../components/Students/FreelanceTeachers.vue';
import SingleFreelanceTeacher from '../components/Students/SingleFreelanceTeacher.vue';
import Favorites from '../components/Students/Favorites/Favorites.vue';
import SingleFavorite from '../components/Students/Favorites/SingleFavorite.vue';
import TrialLessonBooking from '../components/Students/PayPal/TrialLessonBooking.vue'

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
        path: '/student/single/favorite/:id',
        components: { default: SingleFavorite },
        props: { default: true }
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
        path: '/student/freelance/teachers',
        name: "FreelanceTeachers",
        component: FreelanceTeachers
    },
    {
        path: '/student/single/teacher/:id',
        // name: "SingleTeacher",
        // component: SingleTeacher,
        components: { default: SingleFreelanceTeacher },
        props: { default: true }
    },
    {
        path: '/student/single/teacher/messages/:id',
        // name: "SingleTeacher",
        // component: SingleTeacher,
        components: { default: SingleMessage },
        props: { default: true }
    },
    {
        path: "/student/freelance/single/teacher/:id",
        // name: "SingleTeacher",
        // component: SingleTeacher,
        components: { default: SingleFreelanceTeacher },
        props: { default: true }
    },
    {
        path: "/student/book/demo/lesson/:id",
        components: { default: TrialLessonBooking },
        props: { default: true }
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;