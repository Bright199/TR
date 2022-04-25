<template>
    <div class="col-md-9 mb-2 me-2 p-0 LessonContainer">
        <div class="container-jumbotron border-bottom p-3 bg-white">
            <h5 class="text-center">Here are all your paid lessons.</h5>
        </div>
        <div class="container p-0 border-top-0">
            <div class="spinner" v-if="loading == true">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <div class="container-jumbotron p-3" v-if="loaded && paidLessons.length">
                <div
                    class="row shadow-sm mb-2 p-3 bg-white"
                    v-for="(lesson, index) in paidLessons"
                    :key="index"
                >
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/images/avatar.png" alt="" class="rounded-circle" width="60" height="60" v-if="lesson.teacher_image ===null">
                                <img src="/images/avatar.png" alt="" class="rounded-circle" width="60" height="60" v-else>
                            </div>
                            <div class="col-md-9 ">
                                <p style="margin-bottom: 2px;">{{ lesson.teacher_name }}</p>
                                <p>{{ lesson.language }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="margin-bottom: 2px">Booked: </p>
                                <p><span style="color: #029e20">{{lesson.student_booked_hours}} hours</span></p>
                            </div>
                            <div class="col-md-6">
                                <p style="margin-bottom: 2px">Leson fee: </p>
                                <p><span style="color: #029e20">${{lesson.teacher_hourly_pay}}/hr</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="lesson.remaining_lesson_hours > 0">
                            <div class="container mb-1 d-flex justify-content-end">
                                <router-link to="" style="text-decoration: none;">
                                    <img src="/images/transfer.png" alt="tranfer_lessons" width="25">
                                    &nbsp; Tranfer lessons
                                </router-link>
                            </div>
                            <div class="container d-flex justify-content-end">
                                <router-link :to="'/student/schedule/paid/lesson/'+lesson.teacher_id" style="text-decoration: none; margin-top: 10px">
                                    <img src="/images/schedule.png" alt="calendar" width="25">
                                    &nbsp; Schedule lesson
                                </router-link>
                            </div>
                        </div>
                        <div v-else>
                            <div class="container d-flex justify-content-end">
                                <router-link :to="'/student/book/paid/lesson/'+lesson.teacher_id" 
                                class="buyMore">Buy Hours</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="contnainer py-5" v-if="loaded == true">
                    <span class="d-flex justify-content-center">
                        <img src="/images/profiles.png" alt="" width="210" />
                    </span>
                    <h4 class="d-flex justify-content-center">
                        No booked paid lessons yet!
                    </h4>
                    <p class="d-flex justify-content-center">
                        You can buy your lesson hhours so easily by accessing
                        the teacher's section.
                    </p>
                    <router-link to="#" class="BrowseTeachers"
                        @click="buyHours">Buy Hours</router-link
                    >
                </div>
            </div>
        </div>
        <!-- {{demoLessons}} -->
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
    name: "LessonsLists",
    data() {
        return {
            paidLessons: "",
            loading: false,
            loaded: false,
        };
    },
    mounted() {
        this.getAllBookedDemoLessons();
    },
    methods: {
        buyHours() {
            this.$store.commit({
                type: "buyHours",
            });
        },
        dateTime(value) {
            return moment(value).format("dddd, MMMM Do");
            // moment(value).startOf().fromNow()
        },
        getAllBookedDemoLessons() {
            this.loading = true;
            axios
                .get("/student/getAllBookedPaidLessons/")
                .then((response) => {
                    this.paidLessons = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped>
.buyMore{
    text-decoration: none; 
    margin-top: 10px;
    padding: 2px 15px 5px;
    background-color: #029e02;
    color: white;
    border-radius: 3px;
}
.buyMore:hover{
    background-color: #03ac03
}
/* spinner */
.spinner {
    margin: 100px auto;
    width: 40px;
    height: 40px;
    position: relative;
    text-align: center;

    -webkit-animation: sk-rotate 2s infinite linear;
    animation: sk-rotate 2s infinite linear;
}

.dot1,
.dot2 {
    width: 60%;
    height: 60%;
    display: inline-block;
    position: absolute;
    top: 0;
    background-color: #029e02;
    border-radius: 100%;

    -webkit-animation: sk-bounce 2s infinite ease-in-out;
    animation: sk-bounce 2s infinite ease-in-out;
}

.dot2 {
    top: auto;
    bottom: 0;
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

@-webkit-keyframes sk-rotate {
    100% {
        -webkit-transform: rotate(360deg);
    }
}
@keyframes sk-rotate {
    100% {
        transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
    }
}

@-webkit-keyframes sk-bounce {
    0%,
    100% {
        -webkit-transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
    }
}

@keyframes sk-bounce {
    0%,
    100% {
        transform: scale(0);
        -webkit-transform: scale(0);
    }
    50% {
        transform: scale(1);
        -webkit-transform: scale(1);
    }
}
/*  */
.BrowseTeachers {
    background-color: #029e02;
    padding: 5px 0px 7px;
    color: white;
    display: block;
    text-align: center;
    width: 40%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
    border-radius: 5px;
}
.BrowseTeachers:hover {
    background-color: #02ad02;
}
.LessonContainer{
    min-height: 700px;
    max-height: 800px;
    overflow-y: auto;
}
</style>
