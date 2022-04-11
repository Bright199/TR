import { createRouter, createWebHistory } from 'vue-router';
import RightBar from '../components/Students/RightBar.vue';
import WebRtc from '../components/Students/WebRtc.vue';
import EditStudentProfile from '../components/Students/EditStudentProfile.vue';
import EditProfile from '../components/Students/EditProfile.vue';
import RightNavMain from '../components/RightNavMain.vue';
import StudentAd from '../components/Students/StudentAds/StudentAd.vue';
import StudentAdManagement from '../components/Students/StudentAds/StudentAdManagement.vue';
import SingleAd from '../components/Students/StudentAds/SingleAd.vue';
import StudentDashboard from '../components/Students/StudentDashboard.vue';
import Messages from '../components/Students/Messages/Messages.vue';
import SingleMessage from '../components/Students/Messages/SingleMessage.vue';
import Teachers from '../components/Students/Teachers.vue';
import FreelanceTeachers from '../components/Students/FreelanceTeachers.vue';
import SingleFreelanceTeacher from '../components/Students/SingleFreelanceTeacher.vue';
import Favorites from '../components/Students/Favorites/Favorites.vue';
import SingleFavorite from '../components/Students/Favorites/SingleFavorite.vue';
import TrialLessonBooking from '../components/Students/PayPal/TrialLessonBooking.vue'
import IncompleteDemoBook from '../components/Students/PayPal/IncompleteDemoBook.vue'
import AllBookedLessons from '../components/Students/PayPal/AllBookedLessons.vue'
import DemoPaymentSummary from '../components/Students/PayPal/DemoPaymentSummary.vue'
import SingleDemoLesson from '../components/Students/PayPal/SingleDemoLesson.vue'
const newLocal = 'Home';
const routes = [
    {
        path: '/',
        name: 'RightNavMain',
        component: RightNavMain
    },
    {
        path: '/zoom',
        name: 'WebRtc',
        component: WebRtc
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
        path: '/student/single/ad/:id',
        components: {default: SingleAd},
        props: {default: true}
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
    },
    {
        path: "/student/view/demo/lesson:id",
        components: { default: SingleDemoLesson },
        props: { default: true }
    },
    {
        path: "/student/demo/booking/payment/summary/:id",
        components: { default: DemoPaymentSummary },
        props: { default: true }
    },
    {
        path: "/student/incomplete/demo/booking",
        name: "IncompleteDemoBook",
        components: { default: IncompleteDemoBook },
    },
    {
        path: "/student/all/booked/lessons",
        name: "AllBookedLessons",
        components: { default: AllBookedLessons },
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router;